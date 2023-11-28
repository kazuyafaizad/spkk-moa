<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import { Link,router } from '@inertiajs/vue3';
import Pagination from '@/Components/Pagination.vue';
import { ref,onMounted } from 'vue';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import Select from 'datatables.net-select';
import DataTablesLib from 'datatables.net';
DataTable.use(DataTablesCore);
DataTable.use(Select);
DataTable.use(DataTablesLib);


let dt;
const data = ref([]);
const table = ref();


// Get a DataTables API reference
onMounted(function () {
  dt = table.value.dt;

//   dt.on('click', 'tbody tr', function () {
//     let data = dt.row(this).data();

//     alert('You clicked on ' + data[0] + "'s row");
// });
});


const columns = [
  { data: 'title', title: 'Tajuk' },
  { data: 'content', title: 'Konten' },
  { data: 'status', title: 'Status',"defaultContent": "<i>Not set</i>",
  "render": function ( data, type, row, meta ) {
      return data == true ? "<span class='text-success font-bold'>Aktif</span>" : "<span class='text-danger font-bold'>Tidak Aktif</span>";
    }}
];

const edit = ()=>{
     dt.rows({ selected: true }).every(function () {
        router.get(route('admin.announcement.edit',{announcement: this.data()}));
    });
}

const destroy = ()=>{
    dt.rows({ selected: true }).every(function () {
        if(confirm("Anda Pasti untuk memadam?")){
            router.delete(route('admin.announcement.destroy',{announcement: this.data()}),{
            onFinish:()=>{
                alert("Telah Berjaya dipadam")
            }
        });
        }

    });
}
</script>

<template>
    <AppLayout title="Admin">
        <template #header>
            <h2 class="font-semibold text-2xl  text-[#3b3f5c]">
                    Pengumuman Awam
            </h2>
        </template>

        <div>
            <div  class="w-full max-w-full mb-4 bg-transparent">
                <div class="flex gap-2 my-2">
                        <Link class="btn btn-primary rounded " :href="route('admin.announcement.create')" as="button"
                            v-if="$page.props.auth.user?.role_id === 2">Tambah</Link>
                            <button class="btn btn-secondary rounded " @click="edit">Kemaskini</button>
                             <button class="btn btn-danger rounded " @click="destroy">Padam</button>
                </div>
                         <DataTable :data="$page.props.announcement.data" class="display table w-full" :columns="columns" :options="{ select: true }" ref="table"></DataTable>
            </div>
        </div>
</AppLayout>
</template>
