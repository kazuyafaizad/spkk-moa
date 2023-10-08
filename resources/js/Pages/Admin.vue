<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { Link } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import { ref,onMounted } from 'vue';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import Select from 'datatables.net-select';
import DataTablesLib from 'datatables.net';
DataTable.use(DataTablesCore);
DataTable.use(Select);
DataTable.use(DataTablesLib);

const pageView = ref("announcement");
// const table = ref();
// let dt;

const changeView = (view) => {
    pageView.value = view
}

// Get a DataTables API reference
// onMounted(function () {
//   dt = table.value.dt;
// });


const recipeColumns = [
  { data: 'title', title: 'Tajuk' },
//   { data: 'premise_type', title: 'Premis' },
//   { data: 'park_name', title: 'Lokasi' },
//   { data: 'activity_code', title: 'Aktiviti' },
//   { data: 'date', title: 'Tarikh' },
//   { data: 'frequency', title: 'Hari Kutipan' },
//   { data: 'time_start', title: 'Mula' },
//   { data: 'time_end', title: 'Tamat' },
];

function update() {
  dt.rows({ selected: true }).every(function () {
    alert("hje")
    let row = this.data();

    row.a += ' Updated';
    row.b += ' Updated';
    row.c += ' Updated';
  });
}
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
                            <div class="hover:cursor-pointer" @click="changeView('aduan')"><li class="py-3 px-2 hover:bg-teal-300 border-b-2 border-blue-900" :class="{ 'bg-teal-300' : pageView == 'aduan' }">Aduan</li></div>
                            <div class="hover:cursor-pointer" @click="changeView('announcement')"><li class="py-3 px-2 hover:bg-teal-300 border-b-2 border-blue-900" :class="{ 'bg-teal-300' : pageView == 'announcement' }">Pengumuman</li></div>
                            <div class="hover:cursor-pointer" @click="changeView('recipe')"><li class="py-3 px-2 hover:bg-teal-300 border-b-2 border-blue-900" :class="{ 'bg-teal-300' : pageView == 'recipe'}">Resepi Leftover</li></div>
                        </ul>
                    </div>
                </div>

            <div class="mt-5 md:mt-0 md:col-span-2">
                 <div v-if="pageView == 'aduan'">
                            <h2>Aduan</h2>

                            <table>
                                <thead>
                                    <th>Bil.</th>
                                    <th>Tajuk</th>
                                </thead>
                                <tbody>
                                    <tr v-for="(complaint, i) in $page.props.complaint.data" :key="i">
                                        <td>{{ (pageSize * currentPage) - pageSize + i + 1 }}</td>
                                        <td><Link :href="route('complaint.edit', { complaint: complaint.id })">{{ complaint.title }}</Link></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="mt-4">
                               <Pagination class="mt-6" :links="$page.props.recipe.links" />
                            </div>
                    </div>

                 <div v-if="pageView == 'announcement'">
                        <h2>Pengumuman Awam</h2>
                        <Link class="btn btn-primary rounded my-4"  :href="route('announcement.create')" as="button" v-if="$page.props.auth.user?.role_id === 2">Tambah Pengumuman</Link>
                        <table>
                            <thead>
                                <th>Bil.</th>
                                <th>Tajuk</th>
                            </thead>
                            <tbody>
                                <tr v-for="(announcement, i) in $page.props.announcement.data" :key="i">
                                    <td>{{ (pageSize * currentPage) - pageSize + i + 1 }}</td>
                                    <td><Link :href="route('announcement.edit', { announcement: announcement.id })">{{ announcement.title }}</Link></td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- <div class="mt-4">
                           <Pagination class="mt-6" :links="$page.props.announcement.links" />
                        </div> -->
                </div>
                <div v-if="pageView == 'recipe'">

                    <h2>Resepi Leftover</h2>
                    <Link class="btn btn-primary rounded my-4"  :href="route('resepileftover.create')" as="button" v-if="$page.props.auth.user?.role_id === 2">Tambah Resipi</Link>
<!--
                    <DataTable :data="$page.props.recipe" class="display table"  :columns="recipeColumns"  :options="{ select: true }" ref="table">

                    </DataTable> -->

                    <table class="table w-full">
                        <thead class="border">
                            <th class="p-2 bg-teal-100">Bil.</th>
                            <th class="p-2 bg-teal-100">Tajuk</th>
                        </thead>
                        <tbody class="border">
                            <tr v-for="(recipe,i) in $page.props.recipe.data" :key="i">
                                <td class="p-2">{{ ($page.props.recipe.per_page * $page.props.recipe.current_page) - $page.props.recipe.per_page + i + 1 }}</td>
                                <td class="p-2"><Link :href="route('resepileftover.edit',{recipe:recipe.id})">{{ recipe.title }}</Link></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mt-4">
                       <Pagination class="mt-6" :links="$page.props.recipe.links" />
                    </div>
                </div>
            </div>
        </div>
        </div>
    </AppLayout>
</template>
