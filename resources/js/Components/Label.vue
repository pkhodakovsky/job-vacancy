<script setup>
defineProps(['classes']);
</script>

<template>

  <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded uppercase last:mr-0 mr-1" :class="classes"><slot /></span>

</template>
