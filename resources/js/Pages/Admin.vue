<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <AppLayout title="Admin">
        <template #header>
            <h2 class="font-semibold text-2xl  text-[#3b3f5c]">
                Admin
            </h2>
        </template>

        <div>
            <div class="md:grid md:grid-cols-4 md:gap-6">
                <div class="md:col-span-1 flex justify-between">
                    <div class="px-4 sm:px-0 w-full">
                        <ul class="mt-1 text-sm text-gray-600">
                            <Link href="#"><li class="py-3 px-2 hover:bg-gray-300 border-b-2">Pengumuman</li></Link>
                            <Link href="#"><li class="py-3 px-2 hover:bg-gray-300 border-b-2">Resepi Leftover</li></Link>
                        </ul>
                    </div>
                </div>

            <div class="mt-5 md:mt-0 md:col-span-2">
                Pengumuman

                <div>
                    <h2>Resepi Leftover</h2>
                    <Link class="btn btn-primary rounded my-4"  :href="route('resepileftover.create')" as="button" v-if="$page.props.auth.user?.role_id === 2">Tambah Resipi</Link>
                    <table>
                        <thead>
                            <th>Bil.</th>
                            <th>Tajuk</th>
                        </thead>
                        <tbody>
                            <tr v-for="(recipe,i) in $page.props.recipe.data" :key="i">
                                <td>{{ i+1 }}</td>
                                <td><Link :href="route('resepileftover.edit',{recipe:recipe.id})">{{ recipe.title }}</Link></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </AppLayout>
</template>
