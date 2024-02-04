<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import FormJadual from "./Partials/FormJadual.vue";

defineProps({
    filters: Object,
});
</script>

<template>
    <AppLayout title="Aduan">
        <template #header>
            <h2 class="font-semibold text-2xl text-[#3b3f5c]"></h2>
        </template>

        <FormJadual :filters="filters" />
    </AppLayout>
</template>
