<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SectionBorder from '@/Components/SectionBorder.vue';
import EditRecipeLeftoverForm from './Partials/EditAnnouncementForm.vue';

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
});
</script>

<template>
    <AppLayout title="Tambah Pengumuman Awam">
        <template #header>
            <h2 class="font-semibold text-2xl  text-[#3b3f5c]">
                Pengumuman Awam
            </h2>
        </template>

        <div>
            <div class="w-full max-w-full mb-4 bg-transparent">
                <EditRecipeLeftoverForm :recipe="$page.props.recipe" />
            </div>
        </div>
    </AppLayout>
</template>
