<script setup>
const props = defineProps({
    vacancy: {
        default: [],
    },
});
</script>
<template>
    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-l">
        <div class="flex items-center">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                 stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-500"><path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <div class="ml-4 text-lg leading-7 font-semibold text-gray-900 dark:text-white"> <a target="_blank" :href="'/vacancy/'+vacancy.id">{{vacancy.title}}</a> </div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-gray-600 dark:text-gray-400 text-sm">
                {{vacancy.body}}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "JobVacancyCart"
}
</script>

<style scoped>

</style>
