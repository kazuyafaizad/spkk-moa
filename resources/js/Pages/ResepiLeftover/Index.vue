<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';


const resepi = [
    {
        "nama":"resepi baru 1",
        "bahan":"Nasi"
    },
    {
        "nama":"resepi baru 24",
        "bahan":"Nasi"
    },
    {
        "nama":"resepi baru 3",
        "bahan":"Nasi"
    }
]
</script>

<template>
    <AppLayout title="Resepi Leftover">
        <template #header>
            <h2 class="font-semibold text-2xl  text-[#3b3f5c]">
                Resepi Leftover
            </h2>
        </template>

        <div class="w-full max-w-full mb-4 bg-transparent">
                <Link class="btn btn-primary rounded my-4" :href="route('aduan.create')">Tambah Resepi</Link>

            <div class="grid grid-cols-4 gap-4">
                <div v-for="(r, i) in resepi" :key="i">
                    <div class="max-w-sm rounded overflow-hidden shadow-lg">
                        <img class="w-full" src="/img/card-top.jpg" alt="Sunset in the mountains">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2">{{ r.nama }}</div>
                            <p class="text-gray-700 text-base">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores
                                et perferendis eaque, exercitationem praesentium nihil.
                            </p>
                        </div>
                        <div class="px-6 pt-4 pb-2">
                            <span
                                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
                            <span
                                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
                            <span
                                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </AppLayout>
</template>
