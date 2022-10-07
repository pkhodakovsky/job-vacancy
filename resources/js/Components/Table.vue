<script setup>
import {computed, onMounted, onUnmounted, ref} from 'vue';

const props = defineProps({
    rows: {
        type: [Array],
        default: [],
    },

});


</script>
<template>

    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    Job Id
                </th>
                <th scope="col" class="py-3 px-6">
                    Job Title
                </th>
                <th scope="col" class="py-3 px-6">
                    Like
                </th>
                <th scope="col" class="py-3 px-6">
                    Responses
                </th>
                <th scope="col" class="py-3 px-6">
                    Created At
                </th>
                <th scope="col" class="py-3 px-6">

                </th>

            </tr>
            </thead>
            <tbody>


            <tr class="bg-white dark:bg-gray-800" v-for="row in rows">
                <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    #{{ row.job_no }}
                </th>
                <td class="py-4 px-6">
                    {{ row.title }}
                </td>
                <td class="py-4 px-6">
                    {{row.like_count}}
                </td>
                <td class="py-4 px-6">
                    {{ row.response_count }}
                </td>
                <td class="py-4 px-6">
                    {{ row.created_at }}
                </td>
                <td class="py-4 px-6">
<!--                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>-->
                </td>
            </tr>
            </tbody>
        </table>
    </div>

</template>
<style scoped>

</style>
