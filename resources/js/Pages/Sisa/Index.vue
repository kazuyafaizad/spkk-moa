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
});


const aktivitiOptions = ref(['Kutipan', 'Pembersihan']);
const pbtOptions = ref([{
    name:"",
    id:""
}]);
const tamanOptions = ref([{
    name:"",
    id:""
}]);

const changeNegeri = async () => {
    await axios.get('/pbt/'+form.negeri.id).then(response => pbtOptions.value = response.data).catch(error => console.log(error))
}

const changeTaman = async () => {
    await axios.get('/taman/'+form.pbt.id).then(response => tamanOptions.value = response.data).catch(error => console.log(error))
}

</script>


<template>
    <AppLayout title="Jadual Kutipan/Pembersihan">
        <template #header>
            <h2 class="font-semibold text-2xl  text-[#3b3f5c]">
                Kutipan Sisa Industri
            </h2>
        </template>
        <table class="w-full max-w-full mb-4 bg-transparent">
            <tbody>
                <tr>
                    <td colspan="2">
                        <div class="flex flex-wrap -mr-1 -ml-1 mb-4">
                            <div class="relative flex-grow max-w-full flex-1 px-4">
                                <label>Aktiviti</label>
                                <Multiselect v-model="form.aktiviti" :options="aktivitiOptions" placeholder="Select one">
                                </Multiselect>
                            </div>
                            <div class="relative flex-grow max-w-full flex-1 px-4">
                                <label>Negeri</label>
                                <multiselect v-model="form.negeri" :options="$page.props.negeriOption"
                                    placeholder="Select one" label="name" track-by="id" @select="changeNegeri()">
                                </multiselect>
                            </div>
                            <div class="relative flex-grow max-w-full flex-1 px-4">
                                <label>PBT</label>
                                <multiselect v-model="form.pbt" :options="pbtOptions" placeholder="Select one" label="name"
                                    track-by="id" @select="changeTaman()">
                                </multiselect>
                            </div>
                            <div class="relative flex-grow max-w-full flex-1 px-4">
                                <label>Taman</label>
                                <multiselect v-model="form.taman" :options="tamanOptions" placeholder="Select one"
                                    label="name" track-by="id" @select="changeTaman()">
                                </multiselect>
                            </div>
                            <div class="relative flex-grow max-w-full flex-1 px-4">
                                <label>Jalan</label>
                                <multiselect v-model="form.taman" :options="tamanOptions" placeholder="Select one"
                                    label="name" track-by="id" @select="changeTaman()">
                                </multiselect>
                            </div>
                            <div class="relative flex-grow max-w-full flex-1 px-4">
                                <label>Tarikh</label>
                                <multiselect v-model="form.taman" :options="tamanOptions" placeholder="Select one"
                                    label="name" track-by="id" @select="changeTaman()">
                                </multiselect>
                            </div>
                        </div>
                        <!-- <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline text-blue-600 border-blue-600 hover:bg-blue-600 hover:text-white bg-white hover:bg-blue-600 mb-2">Primary</button> -->
                        <button @click="search" class="btn btn-primary rounded">Cari</button>
                    </td>

                </tr>
            </tbody>
        </table>

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

