<script setup>
import {Head, Link} from '@inertiajs/inertia-vue3';
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import Alert from '@/Components/Alert.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
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

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">


            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">

                    <div class="max-w-sm w-full lg:max-w-full lg:flex">
                        <div class="h-48 lg:h-auto lg:w-48 flex-none bg-cover rounded-t lg:rounded-t-none lg:rounded-l text-center overflow-hidden" style="background-image: url('https://freepngimg.com/thumb/jobs/13-2-jobs-png-pic.png')" :title="jobVacancy.title">
                        </div>
                        <div class="border-r border-b border-l border-gray-400 lg:border-l-0 lg:border-t lg:border-gray-400 bg-white rounded-b lg:rounded-b-none lg:rounded-r p-4 flex flex-col justify-between leading-normal">
                            <div class="mb-8">

                                <div class="text-gray-900 font-bold text-xl mb-2">{{jobVacancy.title}}</div>
                                <p class="text-gray-700 text-base"> {{jobVacancy.body}}</p>
                            </div>
                            <div class="flex items-center">
                                <img class="w-10 h-10 rounded-full mr-4" src="https://icon2.cleanpng.com/20171221/bze/hand-painted-cartoon-business-man-sitting-on-a-chair-5a3c57980a44c4.4755229115139040240421.jpg" :alt="jobVacancy.title">
                                <div class="text-sm">
                                    <p class="text-gray-900 leading-none">{{jobVacancy.name}}</p>
                                    <p class="text-gray-600">{{new Date(jobVacancy.date).toString() }}</p>
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
                                    <PrimaryButton type="submit">Send Job</PrimaryButton>
                                </div>
                            </form>
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
            loading: false,
            jobVacancy: ''
        }
    },
    methods: {
        like(){

        },
        submitResponse() {
            this.success = false;
            axios.post('/jobresponse', Object.assign({"_token": this.$page.props.csrf_token},{'job_vacancy_id':this.id}, this.fields)).then(response => {
                this.success = true;
                this.fields = {};
                console.log(response)
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
    },

}

</script>
