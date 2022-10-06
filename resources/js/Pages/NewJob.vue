<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/inertia-vue3';
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import Alert from '@/Components/Alert.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'


</script>

<template>
    <Head title="New Job"/>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               Create New Job Vacancy
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="submit">
                        <div class="p-6 bg-white border-b border-gray-200">
                            <Alert v-if="errors&&errors.cost" :classes="'bg-red-100'">
                                {{ errors.cost }}
                            </Alert>
                            <div class="mb-6">
                                <InputLabel for="body"
                                            :class="'block mb-2 text-sm font-medium text-gray-900 dark:text-dark-500'">
                                    Job Vacancy Body
                                </InputLabel>
                                <TextInput id="body" v-model="fields.body"
                                           :class="'block p-4 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"/>
                                <Alert v-if="errors&&errors.body" :classes="'bg-red-100'">
                                    {{ errors.body[0] }}
                                </Alert>
                            </div>
                            <div class="mb-6">
                                <InputLabel for="title"
                                            :class="'block mb-2 text-sm font-medium text-gray-900 dark:text-dark-500'">
                                    Job Vacancy Title
                                </InputLabel>
                                <TextInput v-model="fields.title" id="title"
                                           :class="'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"/>

                                <Alert v-if="errors&&errors.title" :classes="'bg-red-100'">
                                    {{ errors.title[0] }}
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
    </AuthenticatedLayout>
</template>
<script>
export default {
    data() {
        return {
            fields: {},
            errors: {},
            success: false,
            loading: false,
        }
    },

    methods: {
        submit() {
            this.success = false;
            axios.post('/jobs', Object.assign({"_token": this.$page.props.csrf_token}, this.fields)).then(response => {
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
};
</script>
