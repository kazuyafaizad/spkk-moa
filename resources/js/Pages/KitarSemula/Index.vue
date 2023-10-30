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
    barangan: [],
    negeri:props.filters.negeri,
    pbt:props.filters.pbt,
    taman:props.filters.taman,
    jalan:props.filters.jalan,
    radius:props.filters.radius
});

const data = ref();

const kemudahanOptions = ref([
    {id:"drop",name:"Drop Off (Tong/Sangkar 3R)"},
    {id:"drop",name:"Buy Back Center"},
    {id:"drop",name:"Perniagaan Kitar Semula"},
    {id:"drop",name:"CRC (CRC Box,Kloth, Tzu Chi)"},
    {id:"drop",name:"KOSIS"},
    {id:"drop",name:"Pusat E-Waste"},
]);


const baranganOptions = ref([
    {id:"kertas",name:"Kertas Putih"},
    {id:"2",name:"Surat Khabar, Kotak, Lain-Lain Kertas"},
    {id:"3",name:"Kotak/Kadbod"},
    {id:"4",name:"Kotak Minuman (Tetrapak)"},
    {id:"5",name:"Lain-Lain Kertas"},
    {id:"6",name:"Botol PET"},
    {id:"7",name:"Botol HDPE/LDPE"},
    {id:"8",name:"Plastik Campuran"},
    {id:"9",name:"Tin Minuman Aluminium"},
    {id:"10",name:"Lain-Lain Aluminium"},
    {id:"11",name:"Tin Makanan"},
    {id:"12",name:"Lain-Lain Besi"},
    {id:"13",name:"Minyak Masak"},
    {id:"14",name:"Sisa Elektronik (E-Waste)"},
    {id:"15",name:"Tekstil"},
    {id:"16",name:"Sisa Makanan"},
]);


const radiusOptions = ref(['1KM', '2KM','3KM', '5KM','10KM', '20KM','30KM','50KM']);

const pbtOptions = ref([{
    name:"",
    id:""
}]);


const changeNegeri = async () => {
    await axios.get('/pbt/'+form.negeri.id).then(response => pbtOptions.value = response.data).catch(error => console.log(error))
}

const search = () => {
    axios.post('https://spmtb.swcorp.my/api/spkkapi',{
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
  { data: 'koordinat', title: 'Koordinat', "defaultContent": "<i>Not set</i>",
  "render": function ( data, type, row, meta ) {
      return '<a href="https://www.google.com/maps/search/?api=1&query='+data+'" style="text-decoration:underline" target="_blank">Buka map</a>';
    } },
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
                                            <multiselect v-model="form.barangan" :multiple="true" :options="baranganOptions" placeholder="Sila Pilih" label="name"
                                                track-by="id" >
                                            </multiselect>
                                        </div>
                            </div>
                        </td>

                    </tr>
                </tbody>
            </table>
             <button @click="search" class="btn btn-primary rounded">Cari</button>
             <button @click="form.reset()" class="btn btn-secondary rounded my-5 ml-4" :class="{ 'p-10': form.processing }">Reset</button>
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
