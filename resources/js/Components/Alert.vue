<script setup>


const props = defineProps({
    classes: {
        default: '',
    },


});


</script>
<template>
    <div   class=" rounded-lg py-5 px-6 mb-4 text-base text-red-700 mb-3" :class="classes" role="alert">
        <slot/>
    </div>
</template>

<script>
export default {
    name: "Alert"
}
</script>

<style scoped>

</style>
