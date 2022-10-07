<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/inertia-vue3';
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import Alert from '@/Components/Alert.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
defineProps({

    settings: Object,
})

</script>

<template>
    <Head title="Change Setting"/>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
             Change Setting
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
                            <div class="mb-6"  >
                                <InputLabel for="coin_limit"
                                            :class="'block mb-2 text-sm font-medium text-gray-900 dark:text-dark-500'">
                                    Coin limit
                                </InputLabel>
                                <TextInput id="coin_limit"
                                           v-model="fields.coin_limit"
                                           :class="'block p-4 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"/>
                                <Alert v-if="errors&&errors.coin_limit" :classes="'bg-red-100'">
                                    {{ errors.coin_limit }}
                                </Alert>
                            </div>
                            <div class="mb-6"  >
                                <InputLabel for="new_user_coin"
                                            :class="'block mb-2 text-sm font-medium text-gray-900 dark:text-dark-500'">
                                    New User Coin Budget Start with
                                </InputLabel>
                                <TextInput id="new_user_coin"
                                           v-model="fields.new_user_coin"
                                           :class="'block p-4 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"/>
                                <Alert v-if="errors&&errors.new_user_coin" :classes="'bg-red-100'">
                                    {{ errors.new_user_coin }}
                                </Alert>
                            </div>
                            <div class="mb-6"  >
                                <InputLabel for="gift_coin_amount"
                                            :class="'block mb-2 text-sm font-medium text-gray-900 dark:text-dark-500'">
                                    How Many Coin Will be Gift Daily
                                </InputLabel>
                                <TextInput id="gift_coin_amount"
                                           v-model="fields.gift_coin_amount"
                                           :class="'block p-4 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"/>
                                <Alert v-if="errors&&errors.gift_coin_amount" :classes="'bg-red-100'">
                                    {{ errors.gift_coin_amount }}
                                </Alert>
                            </div>
                            <div class="mb-6"  >
                                <InputLabel for="job_vacancy_cost"
                                            :class="'block mb-2 text-sm font-medium text-gray-900 dark:text-dark-500'">
                                    New JobVacancy Costs
                                </InputLabel>
                                <TextInput id="job_vacancy_cost"
                                           v-model="fields.job_vacancy_cost"
                                           :class="'block p-4 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500'"/>
                                <Alert v-if="errors&&errors.job_vacancy_cost" :classes="'bg-red-100'">
                                    {{ errors.job_vacancy_cost }}
                                </Alert>
                            </div>

                            <Alert v-if="success" :classes="'bg-green-100'">
                                Successfully Done
                            </Alert>
                            <PrimaryButton type="submit">Save Setting</PrimaryButton>
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
            errors: {},
            success: false,
            fields: {}
        }
    },
    methods: {
        submit(){
            this.success = false;
            axios.put('/setting/setting', Object.assign({"_token": this.$page.props.csrf_token}, this.fields)).then(response => {
                this.success = true;



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
    mounted() {
        this.fields=this.settings;
    }
}
</script>
