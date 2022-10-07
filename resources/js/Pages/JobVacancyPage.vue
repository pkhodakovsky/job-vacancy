<script setup>
import {Head, Link} from '@inertiajs/inertia-vue3';
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import Alert from '@/Components/Alert.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import Label from '@/Components/Label.vue'
defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    id: String,

})
</script>

<template>
    <Head title="Welcome"/>

    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <Link v-if="$page.props.auth.user" :href="'/dashboard'"
                  class="text-sm text-gray-700 dark:text-gray-500 underline">
            </Link>
            <template v-else>
                <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</Link>
                <Link v-if="canRegister" :href="'/register'"
                      class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register
                </Link>
            </template>
        </div>
        <div class="max-w-sm w-full lg:max-w-full lg:flex">
            <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden"  :title="jobVacancy.title">
            </div>
            <div  class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                <div class="mb-8">
                    <p class="text-sm text-gray-600 flex items-center">
                        <svg class="fill-current text-gray-500 w-3 h-3 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M4 8V6a6 6 0 1 1 12 0v2h1a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-8c0-1.1.9-2 2-2h1zm5 6.73V17h2v-2.27a2 2 0 1 0-2 0zM7 6v2h6V6a3 3 0 0 0-6 0z" />
                        </svg>
                        {{jobVacancy.jobNo}}
                    </p>
                    <div class="text-gray-900 font-bold text-xl mb-2">{{jobVacancy.title}}</div>
                    <p class="text-gray-700 text-base"> {{jobVacancy.body}}</p>
                    <Alert v-if="jobLikeSuccess" :classes="'bg-green-100'">
                        {{jobVacancy.title}} Liked Successfully.
                    </Alert>
                    <Alert v-if="errors&&errors.likeVacancy" :classes="'bg-red-100'">
                        {{ errors.likeVacancy }}
                    </Alert>
                    <PrimaryButton @click="likeJobVacancy(jobVacancy.id)" >Like Job Vacancy</PrimaryButton>

                </div>
                <div class="flex items-center">
                    <img class="w-10 h-10 rounded-full mr-4" src="https://www.pngall.com/wp-content/uploads/12/Avatar-Profile-PNG-Photos.png" :alt="jobVacancy.title">
                    <div class="text-sm">
                        <p class="text-gray-900 leading-none">{{jobVacancy.name}}</p>
                        <p class="text-gray-600">{{new Date(jobVacancy.date).toString() }}</p>
                        <Alert v-if="userLikeSuccess" :classes="'bg-green-100'">
                            You Liked  {{jobVacancy.name}}
                        </Alert>
                        <Alert v-if="errors&&errors.likeUser" :classes="'bg-red-100'">
                            {{ errors.likeUser }}
                        </Alert>
                        <PrimaryButton @click="likeUser(jobVacancy.userId)"  >Like User</PrimaryButton>
                    </div>
                </div>
                <form @submit.prevent="submitResponse">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <Alert v-if="errors&&errors.cost" :classes="'bg-red-100'">
                            {{ errors.cost }}
                        </Alert>
                        <div class="mb-6">
                            <InputLabel for="body"
                                        :class="'block mb-2 text-sm font-medium text-gray-900 dark:text-dark-500'">
                                Job Vacancy Response
                            </InputLabel>
                            <TextInput id="body" v-model="fields.body"
                                       :class="'block p-4 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"/>
                            <Alert v-if="errors&&errors.body" :classes="'bg-red-100'">
                                {{ errors.body[0] }}
                            </Alert>
                        </div>

                        <Alert v-if="success" :classes="'bg-green-100'">
                            Successfully Done
                        </Alert>
                        <PrimaryButton type="submit">Send Response</PrimaryButton>
                    </div>
                </form>
                <div class="flex justify-center" v-for="jobResponse in jobResponses">
                    <div class="flex flex-col md:flex-row md:max-w-xl rounded-lg bg-white shadow-lg">
                         <div class="p-6 flex flex-col justify-start">
                            <h5 class="text-gray-900 text-xl font-medium mb-2">{{jobResponse.user.name}}</h5>
                            <p class="text-gray-700 text-base mb-4">
                                {{jobResponse.body}}                            </p>
                            <p class="text-gray-600 text-xs">{{new Date(jobResponse.created_at).toString() }}</p>
                        </div>
                    </div>
                </div>

            </div>
         </div>
    </div>



</template>
<script>
export default {

    data() {
        return {
            fields: {},
            errors: {},
            success: false,
            userLikeSuccess:false,
            jobLikeSuccess:false,
            loading: false,
            jobVacancy: '',
            jobResponses:[],
        }
    },
    methods: {
        likeJobVacancy(jobVacancy){
            axios.put('/like/'+jobVacancy, Object.assign({"_token": this.$page.props.csrf_token},{'job_vacancy_id':jobVacancy})).then(response => {
                this.jobLikeSuccess = true;
            }).catch(e => {
                if (e.response.status === 422) {
                    this.errors = e.response.data.errors
                }
                if (e.response.status === 406) {
                    this.errors.likeVacancy = e.response.data.message
                }
            })
        },
        likeUser(userId){
       axios.post('/like', Object.assign({"_token": this.$page.props.csrf_token},{'user_id':userId})).then(response => {
                    this.userLikeSuccess = true;
                }).catch(e => {
                    if (e.response.status === 422) {
                        this.errors = e.response.data.errors
                    }
                    if (e.response.status === 406) {
                        this.errors.likeUser = e.response.data.message
                    }
                })
            },
        getJobVacancyResponse(jobVacancy){
            axios.get('/jobresponse/'+jobVacancy).then(response => {
                console.log(response.data)
                this.jobResponses = response.data;
            })
        },
        submitResponse() {
            this.success = false;
            axios.post('/jobresponse', Object.assign({"_token": this.$page.props.csrf_token},{'job_vacancy_id':this.id}, this.fields)).then(response => {
                this.success = true;
                this.fields = {};
            }).catch(e => {
                if (e.response.status === 422) {
                    this.errors = e.response.data.errors
                }
                if (e.response.status === 406) {
                    this.errors.cost = e.response.data.message
                }
            })
        }
    },
    mounted(){
        axios.get('/jobs/'+this.id).then(response => {
            this.jobVacancy = response.data.data;
        })
        this.getJobVacancyResponse(this.id)
    },

}

</script>
