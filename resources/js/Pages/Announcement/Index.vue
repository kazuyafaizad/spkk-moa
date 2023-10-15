<script setup>
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, router, useForm } from '@inertiajs/vue3';




const form = useForm({
    search: "",
});


</script>

<template>
    <AppLayout title="Resepi Leftover">

        <template #header>
            <h2 class="font-semibold text-2xl  text-[#3b3f5c]">
                Resepi Leftover
            </h2>
        </template>

        <div class="w-full max-w-full mb-4 bg-transparent">
            <div class="my-4">

                <!-- <button class="btn btn-secondary rounded ml-4 my-4" v-if="$page.props.auth.user?.role_id === 2" >Post saya</button> -->
                <div class="font-sans text-black   bg-white flex items-center justify-center w-1/4">
                    <div class="border rounded overflow-hidden grid grid-cols-6 w-full">
                        <input type="text" class="px-4 py-2 col-span-5" placeholder="Cari Resipi Leftover" v-model="form.search">
                        <button class="flex items-center justify-center px-4 border-l" @click="useSearch">
                        <svg class="h-4 w-4 text-grey-dark" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"/></svg>
                        </button>
                    </div>
                    </div>
            </div>


              <h4 class="font-bold mt-12 pb-2 border-b border-gray-200">
                Resepi Terkini
              </h4>
            <div class="mt-8 grid lg:grid-cols-3 gap-10">
            <template v-for="(r, i) in $page.props.recipe.data" :key="i">
                <Link :href="route('resepileftover.show', { recipe: r.id })">
                <div class="card hover:shadow-lg transform transition duration-500 z-10" >
                    <img
                    :src="r.image"
                    alt="stew"
                    class="w-full h-32 sm:h-48 object-cover"
                    />
                    <div class="m-4">
                    <span class="font-bold">{{ r.title }}</span>
                    <span class="block  text-sm">Resepi Oleh {{ r.created_by_user.name }}</span>
                    </div>
                    <div class="badge">
                    <svg
                        class="w-5 inline-block"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>
                    <span>25 mins</span>
                    </div>
                </div>
                </Link>
            </template>
            </div>
        </div>

    </AppLayout>
</template>
