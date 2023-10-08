<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import FormMaklumatAsas from './Partials/FormMaklumatAsas.vue';
import FormJadual from './Partials/FormJadual.vue';
import FormAduan from './Partials/FormAduan.vue';

defineProps({
    filters: Object,
});

</script>

<template>
    <AppLayout title="Aduan">
        <template #header>
            <h2 class="font-semibold text-2xl  text-[#3b3f5c]">
                Aduan
            </h2>
        </template>

        <!-- <FormMaklumatAsas /> -->
        <FormJadual :filters="filters"/>
        <FormAduan />
    </AppLayout>
</template>
