<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import CreateAnnouncementForm from "@/Pages/Announcement/Partials/CreateAnnouncementForm.vue";

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
});
</script>

<template>
    <AppLayout title="Tambah Pengumuman">
        <template #header>
            <h2 class="font-semibold text-2xl text-[#3b3f5c]">
                Pengumuman Awam
            </h2>
        </template>

        <div>
            <div class="w-full max-w-full mb-4 bg-transparent">
                <CreateAnnouncementForm
                    :announcement="$page.props.announcement"
                />
            </div>
        </div>
    </AppLayout>
</template>
