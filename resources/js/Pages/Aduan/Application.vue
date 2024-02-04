<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import FormAduan from "./Partials/FormAduan.vue";

defineProps({
    selected: Object,
});
</script>

<template>
    <AppLayout title="Aduan">
        <template #header>
            <h2 class="font-semibold text-2xl text-[#3b3f5c]"></h2>
        </template>

        <!-- <FormMaklumatAsas /> -->
        <FormAduan :data="selected" />
    </AppLayout>
</template>
