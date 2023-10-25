<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { onMounted, ref,onBeforeMount } from 'vue';
import { Head, useForm,router,usePage  } from '@inertiajs/vue3';
import {Multiselect} from 'vue-multiselect';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';

DataTable.use(DataTablesCore);

const props = defineProps({
     filters: Object,
})


const form = useForm({
    kemudahan: props.filters.kemudahan,
    barangan: props.filters.barangan,
    negeri:props.filters.negeri,
    pbt:props.filters.pbt,
    taman:props.filters.taman,
    jalan:props.filters.jalan,
    radius:props.filters.radius
});

const data = ref();

const kemudahanOptions = ref([{id:"drop",name:"Drop"}]);

const baranganOptions = ref([{id:"kertas",name:"Kertas"}]);

const radiusOptions = ref(['Kutipan Sisa Pepejal', 'Pembersihan Awam']);

const pbtOptions = ref([{
    name:"",
    id:""
}]);


const changeNegeri = async () => {
    await axios.get('/pbt/'+form.negeri.id).then(response => pbtOptions.value = response.data).catch(error => console.log(error))
}

const search = () => {
    axios.post('https://spmtb.swcorp.my/api/spkkapi?negeri=1&pbt=18&kemudahan=drop&barang=kertas',{
        negeri:form.negeri.id,
        pbt:form.pbt.id,
        kemudahan:form.kemudahan.value,
        barang:form.barangan.value
    }).then(response => {
        if (response.data) {
            data.value = response.data
           console.log(response)
        } else {
        }
    });
};

const columns = [
  { data: 'alamat', title: 'Alamat' },
  { data: 'harga', title: 'harga' },
  { data: 'jenisKemudahan', title: 'Jenis Kemudahan' },
  { data: 'kategori', title: 'Kategori' },
  { data: 'komposisi', title: 'Komposisi' },
  { data: 'namaPegawai', title: 'Nama Pegawao' },
  { data: 'namaSyarikat', title: 'Nama Syarikat' },
  { data: 'emel', title: 'emel' },
  { data: 'noFaks', title: 'No Faks' },
  { data: 'noPhone', title: 'No Telefon' },
  { data: 'koordinat', title: 'Koordinat' },
];

</script>

<template>
    <AppLayout title="Kitar Semula(3R)">
        <template #header>
            <h2 class="font-semibold text-2xl  text-[#3b3f5c]">
                Kitar Semula(3R)
            </h2>
        </template>
         <table class="w-full max-w-full mb-4 bg-transparent">
                <tbody>
                    <tr>
                        <td colspan="2">
                            <div class="grid grid-cols-2 gap-2">
                                <div class="relative flex-grow max-w-full flex-1 px-4">
                                    <label>Pilih Negeri</label>
                                    <multiselect v-model="form.negeri" :options="$page.props.negeriOption"
                                        placeholder="Sila Pilih" label="name" track-by="id" @select="changeNegeri()">
                                    </multiselect>
                                </div>
                                <div class="relative flex-grow max-w-full flex-1 px-4">
                                    <label>Pilih PBT</label>
                                    <multiselect v-model="form.pbt" :options="pbtOptions" placeholder="Sila Pilih" label="name"
                                        track-by="id" >
                                    </multiselect>
                                </div>

                                 <div class="relative flex-grow max-w-full flex-1 px-4">
                                        <label>Pilih Kemudahan</label>
                                        <multiselect v-model="form.kemudahan" :options="kemudahanOptions" placeholder="Sila Pilih" label="name"
                                            track-by="id" >
                                        </multiselect>
                                    </div>
                                <div class="relative flex-grow max-w-full flex-1 px-4">
                                            <label>Pilih Barangan</label>
                                            <multiselect v-model="form.barangan" :options="baranganOptions" placeholder="Sila Pilih" label="name"
                                                track-by="id" >
                                            </multiselect>
                                        </div>
                            </div>
                        </td>

                    </tr>
                </tbody>
            </table>
             <button @click="search" class="btn btn-primary rounded">Cari</button>
             <div class="mt-4">
              <DataTable :data="data" class="display table" :columns="columns">
                <thead>
                    <tr>

                    </tr>
                </thead>
            </DataTable>
            </div>
    </AppLayout>
</template>
