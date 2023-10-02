<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
});

const checkURL = (url) =>{
     const urlRegex = /^(https?|ftp):\/\/[^\s/$.?#].[^\s]*$/i;
    return urlRegex.test(url);
}
</script>

<template>
    <AppLayout title="Tambah Resepi Leftover">
        <template #header>
            <h2 class="font-semibold text-2xl  text-[#3b3f5c]">
                {{  $page.props.recipe.title }}
            </h2>
        </template>

        <div>
            <div class="w-full max-w-full mb-4 bg-transparent">
                <img :src="checkURL($page.props.recipe.image) ? $page.props.recipe.image : '/'+$page.props.recipe.image" class="w-full" >
                <p>{{ $page.props.recipe.description }}</p>
            </div>
        </div>
    </AppLayout>
</template>
