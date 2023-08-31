<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import { Head, useForm,router  } from '@inertiajs/vue3';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net';

DataTable.use(DataTablesCore);

const form = useForm({
    aktiviti: '',
    negeri:'',
    pbt:'',
    taman:'',
});

const pbtOptions = ref([]);
const tamanOptions = ref([]);

const changeNegeri = () => {
    axios.get('/pbt/'+form.negeri).then(response => pbtOptions.value = response.data).catch(error => console.log(error))
}

const changeTaman = () => {
    axios.get('/taman/'+form.pbt).then(response => tamanOptions.value = response.data).catch(error => console.log(error))
}

const data = [
  ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'],
   ['JALAN SRI SULONG UTAMA','PUSAT PENJAJA AWAM/SWASTA', 'GERAI UPTOWN SERI SULONG','KI','15-08-2023','SELASA','08:30:00','09:00:00'],
    ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'],
     ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'],
   ['JALAN SRI SULONG UTAMA','PUSAT PENJAJA AWAM/SWASTA', 'GERAI UPTOWN SERI SULONG','KI','15-08-2023','SELASA','08:30:00','09:00:00'],
    ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'],
     ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'],
   ['JALAN SRI SULONG UTAMA','PUSAT PENJAJA AWAM/SWASTA', 'GERAI UPTOWN SERI SULONG','KI','15-08-2023','SELASA','08:30:00','09:00:00'],
    ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'],
     ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'],
   ['JALAN SRI SULONG UTAMA','PUSAT PENJAJA AWAM/SWASTA', 'GERAI UPTOWN SERI SULONG','KI','15-08-2023','SELASA','08:30:00','09:00:00'],
    ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'],
     ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'],
   ['JALAN SRI SULONG UTAMA','PUSAT PENJAJA AWAM/SWASTA', 'GERAI UPTOWN SERI SULONG','KI','15-08-2023','SELASA','08:30:00','09:00:00'],
    ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'], ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'],
   ['JALAN SRI SULONG UTAMA','PUSAT PENJAJA AWAM/SWASTA', 'GERAI UPTOWN SERI SULONG','KI','15-08-2023','SELASA','08:30:00','09:00:00'],
    ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'],
     ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'],
   ['JALAN SRI SULONG UTAMA','PUSAT PENJAJA AWAM/SWASTA', 'GERAI UPTOWN SERI SULONG','KI','15-08-2023','SELASA','08:30:00','09:00:00'],
    ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'],
     ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'],
   ['JALAN SRI SULONG UTAMA','PUSAT PENJAJA AWAM/SWASTA', 'GERAI UPTOWN SERI SULONG','KI','15-08-2023','SELASA','08:30:00','09:00:00'],
    ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'],
     ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'],
   ['JALAN SRI SULONG UTAMA','PUSAT PENJAJA AWAM/SWASTA', 'GERAI UPTOWN SERI SULONG','KI','15-08-2023','SELASA','08:30:00','09:00:00'],
    ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'],
     ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'],
   ['JALAN SRI SULONG UTAMA','PUSAT PENJAJA AWAM/SWASTA', 'GERAI UPTOWN SERI SULONG','KI','15-08-2023','SELASA','08:30:00','09:00:00'],
    ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'],
     ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'],
   ['JALAN SRI SULONG UTAMA','PUSAT PENJAJA AWAM/SWASTA', 'GERAI UPTOWN SERI SULONG','KI','15-08-2023','SELASA','08:30:00','09:00:00'],
    ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'],
     ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'],
   ['JALAN SRI SULONG UTAMA','PUSAT PENJAJA AWAM/SWASTA', 'GERAI UPTOWN SERI SULONG','KI','15-08-2023','SELASA','08:30:00','09:00:00'],
    ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'], ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'],
   ['JALAN SRI SULONG UTAMA','PUSAT PENJAJA AWAM/SWASTA', 'GERAI UPTOWN SERI SULONG','KI','15-08-2023','SELASA','08:30:00','09:00:00'],
    ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'],
     ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'],
   ['JALAN SRI SULONG UTAMA','PUSAT PENJAJA AWAM/SWASTA', 'GERAI UPTOWN SERI SULONG','KI','15-08-2023','SELASA','08:30:00','09:00:00'],
    ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'],
     ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'],
   ['JALAN SRI SULONG UTAMA','PUSAT PENJAJA AWAM/SWASTA', 'GERAI UPTOWN SERI SULONG','KI','15-08-2023','SELASA','08:30:00','09:00:00'],
    ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'],
     ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'],
   ['JALAN SRI SULONG UTAMA','PUSAT PENJAJA AWAM/SWASTA', 'GERAI UPTOWN SERI SULONG','KI','15-08-2023','SELASA','08:30:00','09:00:00'],
    ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'],
     ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'],
   ['JALAN SRI SULONG UTAMA','PUSAT PENJAJA AWAM/SWASTA', 'GERAI UPTOWN SERI SULONG','KI','15-08-2023','SELASA','08:30:00','09:00:00'],
    ['JALAN SRI SULONG','RUMAH KEDAI > 1 TINGKAT', '-','KI','15-08-2023','SELASA','08:00:00','09:00:00'],
];
</script>

<template>
    <AppLayout title="Jadual Kutipan/Pembersihan">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              Carian Jadual Kutipan/Pembersihan
            </h2>
        </template>
         <table class="w-full max-w-full mb-4 bg-transparent">
                                            <tbody>
                                              <tr>
                                                  <td colspan="2">
                                                    <div class="flex flex-wrap -mr-1 -ml-1 mb-4">
                                                        <div class="relative flex-grow max-w-full flex-1 px-4">
                                                            <label>Aktiviti</label>
                                                            <select v-model="form.aktiviti" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded basic">
                                                                <option selected="selected">Sila pilih</option>
                                                                <option>Kutipan</option>
                                                                <option>Pembersihan</option>
                                                            </select>
                                                        </div>
                                                        <div class="relative flex-grow max-w-full flex-1 px-4">
                                                            <label>Negeri</label>
                                                            <select v-model="form.negeri" @change="changeNegeri()" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded basic">
                                                                <option selected="selected">Sila pilih</option>
                                                                <option :value="negeri.id" v-for="negeri in $page.props.negeriOption" :key="negeri.id">{{negeri.name}}</option>

                                                            </select>
                                                        </div>
                                                        <div class="relative flex-grow max-w-full flex-1 px-4">
                                                            <label>PBT</label>
                                                            <select v-model="form.pbt" @change="changeTaman()" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded basic">
                                                                <option selected="selected">Sila pilih</option>
                                                                 <option :value="pbt.id" v-for="pbt in pbtOptions" :key="pbt.id">{{ pbt.name }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="relative flex-grow max-w-full flex-1 px-4">
                                                            <label>Taman</label>
                                                            <select v-model="form.taman"  class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded basic">
                                                             <option :value="taman.id" v-for="taman in tamanOptions" :key="taman.id">{{ taman.name }}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline text-blue-600 border-blue-600 hover:bg-blue-600 hover:text-white bg-white hover:bg-blue-600 mb-2">Primary</button> -->
                                                    <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-blue-600 text-white hover:bg-blue-600 mb-2">Cari</button>
                                                  </td>

                                              </tr>
                                            </tbody>
                                        </table>


                                         <DataTable :data="data" class="display table">
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
                                        <!-- <table id="range-search" class="display w-full max-w-full mb-4 bg-transparent table-hover" style="width:100%">
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
                                            <tbody>
                                                <tr>
                                                    <td>JALAN SRI SULONG</td>
                                                    <td>RUMAH KEDAI > 1 TINGKAT</td>
                                                    <td>-</td>
                                                    <td>KI</td>
                                                    <td>15-08-2023</td>
                                                    <td>SELASA</td>
                                                    <td>08:00:00</td>
                                                    <td>09:00:00</td>
                                                </tr>
                                                <tr>
                                                    <td>JALAN SRI SULONG UTAMA</td>
                                                    <td>PUSAT PENJAJA AWAM/SWASTA</td>
                                                    <td>GERAI UPTOWN SERI SULONG</td>
                                                    <td>KI</td>
                                                    <td>15-08-2023</td>
                                                    <td>SELASA</td>
                                                    <td>08:30:00</td>
                                                    <td>09:00:00</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
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
                                            </tfoot>
                                        </table> -->
    </AppLayout>
</template>
