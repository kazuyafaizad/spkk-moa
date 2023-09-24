<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import FormMaklumatAsas from './Partials/FormMaklumatAsas.vue';
</script>

<template>
    <AppLayout title="Aduan">
        <template #header>
            <h2 class="font-semibold text-2xl  text-[#3b3f5c]">
                Aduan
            </h2>
        </template>


        <FormMaklumatAsas />
        <div class="w-full max-w-full mb-4 bg-transparent">


        </div>
    </AppLayout>
</template>
