<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import EditRecipeLeftoverForm from "./Partials/EditRecipeLeftoverForm.vue";

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
});
</script>

<template>
    <AppLayout title="Tambah Discover More">
        <template #header>
            <h2 class="font-semibold text-2xl text-[#3b3f5c]">Discover More</h2>
        </template>

        <div>
            <div class="w-full max-w-full mb-4 bg-transparent">
                <EditRecipeLeftoverForm :recipe="$page.props.recipe" />
            </div>
        </div>
    </AppLayout>
</template>
