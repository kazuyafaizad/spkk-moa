<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import SectionBorder from '@/Components/SectionBorder.vue';
import CreateRecipeLeftoverForm from '@/Pages/ResepiLeftover/Partials/CreateRecipeLeftoverForm.vue';

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
});
</script>

<template>
    <AppLayout title="Tambah Resepi Leftover">
        <template #header>
            <h2 class="font-semibold text-2xl  text-[#3b3f5c]">
                Resepi Leftover
            </h2>
        </template>

        <div>
            <div class="w-full max-w-full mb-4 bg-transparent">
                    <CreateRecipeLeftoverForm :recipe="$page.props.recipe" />
            </div>
        </div>
    </AppLayout>
</template>
