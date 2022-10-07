<template>
    <div class="mb-6"  >
        <InputLabel :for="job_response_cost"
                    :class="'block mb-2 text-sm font-medium text-gray-900 dark:text-dark-500'">
            Job response costs
        </InputLabel>
        <TextInput :id="job_response_cost"
                   v-model="fields.job_response_cost"
                   :class="'block p-4 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"/>
        <Alert v-if="errors&&errors.job_response_cost" :classes="'bg-red-100'">
            {{ errors.job_response_cost }}
        </Alert>
    </div>
</template>

<script>
export default {
    name: "SettingInput"
}
</script>

<style scoped>

</style>
