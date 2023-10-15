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


const kemudahanOption = ref(['Kutipan Sisa Pepejal', 'Pembersihan Awam']);

const baranganOptions = ref(['Kutipan Sisa Pepejal', 'Pembersihan Awam']);

const radiusOptions = ref(['Kutipan Sisa Pepejal', 'Pembersihan Awam']);

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

const search = () => {
    axios.post('http://spmtb.swcorp.my/api/spkkapi').then(response => {
        if (response.data) {
           console.log(response)
        } else {
        }
    });
};

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
                                <!-- <div class="relative flex-grow max-w-full flex-1 px-4">
                                    <label>Pilih Senarai Kemudahan</label>
                                    <Multiselect v-model="form.kemudahan" :options="kemudahanOption" placeholder="Sila Pilih">
                                    </Multiselect>
                                </div> -->
                                <!-- <div class="relative flex-grow max-w-full flex-1 px-4">
                                        <label>Pilih Senarai Barangan</label>
                                        <Multiselect v-model="form.barangan" :options="baranganOptions" placeholder="Sila Pilih">
                                        </Multiselect>
                                    </div> -->
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
                                <!-- <div class="relative flex-grow max-w-full flex-1 px-4">
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
                                    <label>Pilih Radius</label>
                                  <multiselect v-model="form.radius" :options="radiusOptions" placeholder="Sila Pilih"
                                            label="name" track-by="id">
                                        </multiselect>
                                </div> -->
                            </div>
                        </td>

                    </tr>
                </tbody>
            </table>
             <button @click="search" class="btn btn-primary rounded">Cari</button>

              <DataTable :data="[]" class="display table" >
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
