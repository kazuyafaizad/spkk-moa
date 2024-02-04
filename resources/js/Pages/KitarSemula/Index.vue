<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { onMounted, ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import { Multiselect } from "vue-multiselect";
import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net";
import maplibregl from "maplibre-gl";
import MaplibreGeocoder from "@maplibre/maplibre-gl-geocoder";
import "@maplibre/maplibre-gl-geocoder/dist/maplibre-gl-geocoder.css";

DataTable.use(DataTablesCore);

const props = defineProps({
    filters: Object,
    barangan: Object,
    kemudahan: Object,
});

const map = ref(null);
const geocoderApi = ref();
const oData = ref();
let geocode;
let selectedData = ref();

onMounted(() => {
    map.value = new maplibregl.Map({
        container: "map",
        // Use a minimalist raster style
        style: {
            version: 8,
            name: "Blank",
            center: [0, 0],
            zoom: 0,
            sources: {
                "raster-tiles": {
                    type: "raster",
                    tiles: ["https://tile.openstreetmap.org/{z}/{x}/{y}.png"],
                    tileSize: 256,
                    minzoom: 15,
                    maxzoom: 19,
                },
            },
            layers: [
                {
                    id: "background",
                    type: "background",
                    paint: {
                        "background-color": "#e0dfdf",
                    },
                },
                {
                    id: "simple-tiles",
                    type: "raster",
                    source: "raster-tiles",
                },
            ],
            id: "blank",
        },
        center: [101.68653, 3.1412],
        zoom: 18,
        pitch: 40,
        bearing: 20,
        antialias: true,
    });

    geocoderApi.value = {
        forwardGeocode: async (config) => {
            const features = [];
            try {
                const request = `https://nominatim.openstreetmap.org/search?q=${config.query}&format=geojson&polygon_geojson=1&addressdetails=1`;
                const response = await fetch(request);
                const geojson = await response.json();
                for (const feature of geojson.features) {
                    const center = [
                        feature.bbox[0] +
                            (feature.bbox[2] - feature.bbox[0]) / 2,
                        feature.bbox[1] +
                            (feature.bbox[3] - feature.bbox[1]) / 2,
                    ];
                    const point = {
                        type: "Feature",
                        geometry: {
                            type: "Point",
                            coordinates: center,
                        },
                        place_name: feature.properties.display_name,
                        properties: feature.properties,
                        text: feature.properties.display_name,
                        place_type: ["place"],
                        center,
                    };
                    features.push(point);
                }
            } catch (e) {
                alert(`Failed to forwardGeocode with error: ${e}`);
            }

            return {
                features,
            };
        },
    };

    geocode = new MaplibreGeocoder(geocoderApi.value, {
        maplibregl,
    });
    map.value.addControl(geocode);
    map.value.addControl(new maplibregl.NavigationControl());

    // map.value = L.map('map').setView([3.1412,101.68653],13);

    // L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    //     attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    // }).addTo(map.value);

    // L.marker([51.5, -0.09]).addTo(map.value)
    //     .bindPopup('A pretty CSS popup.<br> Easily customizable.')
    //     .openPopup();
});

const form = useForm({
    kemudahan: props.filters.kemudahan,
    barangan: [],
    negeri: props.filters.negeri,
    pbt: props.filters.pbt,
    taman: props.filters.taman,
    jalan: props.filters.jalan,
    radius: props.filters.radius,
});

const kemudahanOptions = props.kemudahan;
const baranganOptions = props.barangan;

const pbtOptions = ref([
    {
        name: "",
        id: "",
    },
]);

const changeNegeri = async () => {
    await axios
        .get("/pbt/" + form.negeri.id)
        .then((response) => (pbtOptions.value = response.data));
};

const search = () => {
    form.clearErrors();
    form.processing = true;

    if (form.negeri === null) {
        form.setError("negeri", "Sila pilih Negeri");
    }

    if (form.pbt === null) {
        form.setError("pbt", "Sila pilih PBT");
    }

    if (form.kemudahan == null) {
        form.setError("kemudahan", "Sila pilih salah satu Kemudahan");
    }

    if (form.hasErrors) {
        form.processing = false;
    }

    axios
        .post("https://gateway.swcorp.my/myapp/api/spmtb/kemudahantigar", {
            negeri: form.negeri.id,
            pbt: form.pbt.id,
            kemudahan: form.kemudahan,
            barang: form.barangan,
        })
        .then((response) => {
            form.processing = false;
            if (response.data) {
                oData.value = response.data;
            }
        });
};

const selectId = (id) => {
    selectedData.value = oData.value.find((x, y) => y == id);
    geocode.query(selectedData.value.koordinat);
    geocode.setZoom(18);
};

const resetForm = () => {
    Object.keys(form.data()).forEach((field) => form.defaults(field, null));
    form.reset();
};
</script>

<template>
    <AppLayout title="Kitar Semula(3R)">
        <template #header>
            <h2 class="font-semibold text-2xl text-[#3b3f5c]">
                Kemudahan Kitar Semula
            </h2>
        </template>
        <div class="grid lg:grid-cols-6">
            <div class="col-span-2 bg-white p-2 flex-1">
                <div class="w-full max-w-full mb-4 bg-transparent">
                    <div class="grid lg:grid-cols-1 gap-2">
                        <div class="relative flex-grow max-w-full flex-1 px-4">
                            <label class="required" for="negeri"
                                >Pilih Negeri</label
                            >
                            <multiselect
                                id="negeri"
                                v-model="form.negeri"
                                :options="$page.props.negeriOption"
                                placeholder="Sila Pilih"
                                label="name"
                                track-by="id"
                                @select="changeNegeri()"
                            >
                            </multiselect>
                            <div
                                v-if="form.errors.negeri && !form.negeri"
                                class="text-red-600"
                            >
                                {{ form.errors.negeri }}
                            </div>
                        </div>
                        <div class="relative flex-grow max-w-full flex-1 px-4">
                            <label class="required" for="pbt">Pilih PBT</label>
                            <multiselect
                                id="pbt"
                                v-model="form.pbt"
                                :options="pbtOptions"
                                placeholder="Sila Pilih"
                                label="name"
                                track-by="id"
                            >
                            </multiselect>
                            <div
                                v-if="form.errors.pbt && !form.pbt"
                                class="text-red-600"
                            >
                                {{ form.errors.pbt }}
                            </div>
                        </div>

                        <div class="relative flex-grow max-w-full flex-1 px-4">
                            <label class="required" for="kemudahan"
                                >Pilih Kemudahan</label
                            >
                            <multiselect
                                id="kemudahan"
                                v-model="form.kemudahan"
                                :options="kemudahanOptions"
                                placeholder="Sila Pilih"
                            >
                            </multiselect>
                            <div
                                v-if="form.errors.kemudahan && !form.kemudahan"
                                class="text-red-600"
                            >
                                {{ form.errors.kemudahan }}
                            </div>
                        </div>
                        <div class="relative flex-grow max-w-full flex-1 px-4">
                            <label for="barangan">Pilih Barangan</label>
                            <multiselect
                                id="barangan"
                                v-model="form.barangan"
                                :options="baranganOptions"
                                placeholder="Sila Pilih"
                            >
                            </multiselect>
                            <div
                                v-if="form.errors.barangan && !form.barangan"
                                class="text-red-600"
                            >
                                {{ form.errors.barangan }}
                            </div>
                        </div>
                    </div>
                </div>
                <div></div>
                <button
                    class="btn btn-primary rounded my-5"
                    :disabled="form.processing"
                    title="cari"
                    type="button"
                    @click="search"
                >
                    <i class="bi bi-search"></i> Cari
                </button>
                <button
                    class="btn btn-secondary rounded my-5 ml-4"
                    :disabled="form.processing"
                    title="reset"
                    type="button"
                    @click="resetForm"
                >
                    <i class="bi bi-x-square"></i> Reset
                </button>
                <div class="mt-4">
                    <div class="overflow-auto">
                        <div
                            v-if="form.processing"
                            class="w-12 h-12 rounded-full animate-spin border-y border-solid border-yellow-500 border-t-transparent shadow-md mx-auto"
                        ></div>
                        <ul class="lg:h-[50rem] overflow-auto">
                            <li v-for="(v, i) in oData" :key="i">
                                <div
                                    class="flex p-2 border flex-col hover:cursor-pointer hover:bg-[#38a3a5]/20 hover:duration-[1500ms]"
                                    :tabindex="i"
                                    @click="selectId(i)"
                                >
                                    <p class="text-xl text-[#38a3a5]">
                                        {{ v.namaSyarikat }}
                                    </p>
                                    <span class="text-gray-600">{{
                                        v.alamat
                                    }}</span>
                                </div>
                            </li>
                        </ul>
                        <!-- <DataTable :data="oData" class="display table" ref="table" :columns="columns"
                            :options="{ select: true }" v-else>
                        </DataTable> -->
                    </div>
                </div>
            </div>
            <div id="map" ref="map" class="col-span-4 map-container relative">
                <div
                    v-if="selectedData"
                    id="map-info-detail"
                    class="z-10 absolute p-2"
                >
                    <table
                        class="min-w-full bg-white border border-gray-300 shadow-md rounded-lg overflow-hidden"
                    >
                        <tbody>
                            <tr>
                                <td class="py-1 px-4 border-r">Nama Pegawai</td>
                                <td class="py-1 px-4">
                                    {{ selectedData?.namaPegawai }}
                                </td>
                            </tr>
                            <tr>
                                <td class="py-1 px-4 border-r">E-mel</td>
                                <td class="py-1 px-4">
                                    {{ selectedData?.emel }}
                                </td>
                            </tr>
                            <tr>
                                <td class="py-1 px-4 border-r">No Telefon</td>
                                <td class="py-1 px-4">
                                    {{ selectedData?.noPhone }}
                                </td>
                            </tr>
                            <tr>
                                <td class="py-1 px-4 border-r">No Faks</td>
                                <td class="py-1 px-4">
                                    {{ selectedData?.noFaks }}
                                </td>
                            </tr>
                            <tr>
                                <td class="py-1 px-4 border-r">Kategori</td>
                                <td class="py-1 px-4">
                                    {{ selectedData?.kategori }}
                                </td>
                            </tr>
                            <tr>
                                <td class="py-1 px-4 border-r">Kemudahan</td>
                                <td class="py-1 px-4">
                                    {{ selectedData?.namaKemudahan }}
                                </td>
                            </tr>
                            <tr>
                                <td class="py-1 px-4 border-r">Komposisi</td>
                                <td class="py-1 px-4">
                                    {{ selectedData?.komposisi }}
                                </td>
                            </tr>
                            <tr>
                                <td class="py-1 px-4 border-r"></td>
                                <td class="py-1 px-4">
                                    <a
                                        :href="`https://www.google.com/maps/search/?api=1&query=${selectedData?.koordinat}`"
                                        class="text-primary"
                                        style="text-decoration: underline"
                                        target="_blank"
                                        ><i class="bi bi-map"></i>Dapatkan
                                        Arah</a
                                    >
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<style>
.map-container {
    width: 100%;
    height: 1080px;
}

.maplibregl-ctrl-top-right {
    opacity: 0;
}
</style>
