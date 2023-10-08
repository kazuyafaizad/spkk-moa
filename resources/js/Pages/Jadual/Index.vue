<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { onMounted, ref,onBeforeMount } from 'vue';
import { Head, useForm,router,usePage  } from '@inertiajs/vue3';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';
import {Multiselect} from 'vue-multiselect';
// import 'vue-multiselect/dist/vue3-multiselect.css';

DataTable.use(DataTablesCore);

const props = defineProps({
     filters: Object,
})

const form = useForm({
    aktiviti: props.filters.aktiviti,
    negeri:props.filters.negeri,
    pbt:props.filters.pbt,
    taman:props.filters.taman,
    jalan:props.filters.jalan,
    tarikh:props.filters.tarikh
});


const aktivitiOptions = ref(['Kutipan Sisa Pepejal', 'Pembersihan Awam']);
const pbtOptions = ref([{
    name:"",
    id:""
}]);

const tamanOptions = ref([{
    name:"",
    id:""
}]);

const jalanOptions = ref([{
    name:"",
    id:""
}]);

const changeNegeri = async () => {
    await axios.get('/pbt/'+form.negeri.id).then(response => pbtOptions.value = response.data).catch(error => console.log(error))
}

const changeTaman = async () => {
    await axios.get('/taman/'+form.pbt.id).then(response => tamanOptions.value = response.data).catch(error => console.log(error))
}

const changeJalan = async () => {
    await axios.get('/jalan/'+form.taman.id).then(response => jalanOptions.value = response.data).catch(error => console.log(error))
}

onBeforeMount(() => {
    // changeNegeri(),
    // changeTaman()
})

const columns = [
  { data: 'street_name', title: 'Jalan' },
  { data: 'premise_type', title: 'Premis' },
  { data: 'park_name', title: 'Lokasi' },
  { data: 'activity_code', title: 'Aktiviti' },
  { data: 'date', title: 'Tarikh' },
  { data: 'frequency', title: 'Hari Kutipan' },
  { data: 'time_start', title: 'Mula' },
  { data: 'time_end', title: 'Tamat' },
];

const data = [
];

const search = () => router.visit(route('jadual.index',form),{
     preserveState: true,
    only:['jadual'],

});

</script>

<template>
    <AppLayout title="Jadual Kutipan/Pembersihan">
        <template #header>
            <h2 class="font-semibold text-2xl  text-[#3b3f5c]">
                Carian Jadual Kutipan/Pembersihan
            </h2>
        </template>
        <table class="w-full max-w-full mb-4 bg-transparent">
            <tbody>
                <tr>
                    <td colspan="2">
                        <div class="grid grid-cols-2 gap-2">
                            <div class="relative flex-grow max-w-full flex-1 px-4">
                                <label>Pilih Jenis Jadual</label>
                                <Multiselect v-model="form.aktiviti" :options="aktivitiOptions" placeholder="Sila Pilih">
                                </Multiselect>
                            </div>
                            <div class="relative flex-grow max-w-full flex-1 px-4">
                                <label>Pilih Negeri</label>
                                <multiselect v-model="form.negeri" :options="$page.props.negeriOption"
                                    placeholder="Sila Pilih" label="name" track-by="id" @select="changeNegeri()">
                                </multiselect>
                            </div>
                            <div class="relative flex-grow max-w-full flex-1 px-4">
                                <label>Pilih PBT</label>
                                <multiselect v-model="form.pbt" :options="pbtOptions" placeholder="Sila Pilih" label="name"
                                    track-by="id" @select="changeTaman()">
                                </multiselect>
                            </div>
                            <div class="relative flex-grow max-w-full flex-1 px-4">
                                <label>Pilih Taman</label>
                                <multiselect v-model="form.taman" :options="tamanOptions" placeholder="Sila Pilih"
                                    label="name" track-by="id" @select="changeJalan()">
                                </multiselect>
                            </div>
                            <div class="relative flex-grow max-w-full flex-1 px-4">
                                <label>Pilih Jalan</label>
                                <multiselect v-model="form.jalan" :options="jalanOptions" placeholder="Sila Pilih"
                                    label="name" track-by="id">
                                </multiselect>
                            </div>
                            <div class="relative flex-grow max-w-full flex-1 px-4">
                                <label>Pilih Tarikh</label>
                               <input type="date" v-model="form.tarikh" class="multiselect__input">
                            </div>
                        </div>
                    </td>

                </tr>
            </tbody>
        </table>


        <!-- <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline text-blue-600 border-blue-600 hover:bg-blue-600 hover:text-white bg-white hover:bg-blue-600 mb-2">Primary</button> -->
        <button @click="search" class="btn btn-primary rounded my-5" :class="{'p-10':form.processing}" >Cari</button>

        <DataTable :data="$page.props.jadual" class="display table" :columns="columns">
            <thead>
                <tr>
                    <th>Jalan</th>
                    <th>Premis</th>
                    <th>Lokasi</th>
                    <th>Aktiviti</th>
                    <th>Tarikh</th>
                    <th>Hari Kutipan</th>
                    <th>Mula</th>
                    <th>Tamat</th>
                </tr>
            </thead>
        </DataTable>
    </AppLayout>
</template>
