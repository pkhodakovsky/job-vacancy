<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from  '@/Components/TextInput.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'


</script>

<template>
    <Head title="New Job" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                New Job {{action}}
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form @submit.prevent="submit"  >
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="mb-6">
                            <InputLabel for="body" :class="'block mb-2 text-sm font-medium text-gray-900 dark:text-dark-500'">Job Vacancy Body</InputLabel>
                            <TextInput id="body" :class="'block p-4 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'" />
                        </div>
                        <div class="mb-6">
                            <InputLabel for="title" :class="'block mb-2 text-sm font-medium text-gray-900 dark:text-dark-500'">Job Vacancy Title</InputLabel>
                            <TextInput id="title" :class="'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'" />
                        </div>
                        <PrimaryButton type="button" >Send Job</PrimaryButton>
                    </div>
                        <div v-if="success" class="alert alert-success mt-3">
                            Message sent!
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
            loaded: true,
            action: '',
        }
    },

    // methods: {
    //     destroy(id) {
    //         this.$inertia.delete(route("posts.destroy", id));
    //     },
    // },
};
</script>
