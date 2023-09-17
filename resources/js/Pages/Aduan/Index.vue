<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
</script>

<template>
    <AppLayout title="Aduan">
        <template #header>
            <h2 class="font-semibold text-2xl  text-[#3b3f5c]">
                Aduan
            </h2>
        </template>

        <div class="w-full max-w-full mb-4 bg-transparent">
            <button class="btn btn-primary rounded">Tambah Aduan</button>

        </div>
    </AppLayout>
</template>
