<script setup>
import {Head, Link} from '@inertiajs/inertia-vue3';
import JobVacancyCart from "@/Components/JobVacancyCart.vue";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
})
</script>

<template>
    <Head title="Welcome"/>

    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100  sm:items-center sm:pt-0">
        <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <Link v-if="$page.props.auth.user" :href="'/login'"
                  class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard
            </Link>

            <template v-else>
                <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</Link>

                <Link v-if="canRegister" :href="'/register'"
                      class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register
                </Link>
            </template>
        </div>

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                 <img width="200" src="https://www.kindpng.com/picc/m/133-1337806_job-vector-seeker-job-logo-magnifying-glass-png.png"
/>            </div>

            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <JobVacancyCart v-for="jobVacancy in jobVacancies" :vacancy="jobVacancy"/>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            jobVacancies: []
        }
    },
    mounted() {
        axios.get('/jobs').then(response => {
            this.jobVacancies = response.data;
        })
    }
}

</script>
