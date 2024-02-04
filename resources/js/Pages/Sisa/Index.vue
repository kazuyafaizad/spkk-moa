<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net";
import { Multiselect } from "vue-multiselect";

DataTable.use(DataTablesCore);

const props = defineProps({
    filters: { type: Object, required: true },
});

const form = useForm({
    jenis: props.filters.jenis,
    negeri: props.filters.negeri,
    pbt: props.filters.pbt,
    skim: props.filters.skim,
});

const data = ref();

const jenisOptions = ref([
    { id: "ICI", value: "Sisa Industri (CII)" },
    { id: "CND", value: "Sisa Perobohan (CND)" },
]);
const pbtOptions = ref([
    {
        name: "",
        id: "",
    },
]);
const skimOptions = ref([
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

const changePbt = async () => {
    await axios
        .get("/scheme/" + form.pbt.id)
        .then((response) => (skimOptions.value = response.data));
};

const search = async () => {
    form.processing = true;
    if (form.jenis == null) {
        form.setError("jenis", "Sila pilih Jenis Sisa Industri");
    }

    if (form.negeri === null) {
        form.setError("negeri", "Sila pilih Negeri");
    }

    if (form.pbt === null) {
        form.setError("pbt", "Sila pilih PBT");
    }

    if (form.hasErrors) {
        form.processing = false;
    }

    switch (form.jenis.id) {
        case "ICI":
            await axios
                .post("https://gateway.swcorp.my/myapp/api/edici/pemungut", {
                    negeri_id: form.negeri.id,
                    pbt_kod: form.pbt.name,
                    skim_id: form.skim?.id,
                })
                .then((response) => {
                    data.value = response.data.data;
                    form.processing = false;
                });

            break;
        case "CND":
            await axios
                .post("https://gateway.swcorp.my/myapp/api/cnd/pemungut", {
                    negeri_id: form.negeri.id,
                    pbt_kod: form.pbt.name,
                    skim_id: form.skim?.id,
                })
                .then((response) => {
                    data.value = response.data.data;
                    form.processing = false;
                });

            break;
        default:
            break;
    }
};

const columns = [
    { data: "syarikat_nama", title: "Nama Syarikat" },
    {
        data: "",
        title: "Alamat",
        defaultContent: "<i>Not set</i>",
        render: function (data, type, row) {
            return `${row.syarikat_alamat1},${row.syarikat_negeri}`;
        },
    },
    { data: "notel", title: "No Telefon" },
    {
        data: "emel",
        title: "E-mel",
        render: function (data, type, row) {
            return `<a href='mailto:${row.emel}' class='text-primary underline'>${row.emel}</a>`;
        },
    },
];

const resetForm = () => {
    Object.keys(form.data()).forEach((field) => form.defaults(field, null));
    form.reset();
};
</script>

<template>
    <AppLayout title="Jadual Kutipan/Pembersihan">
        <template #header>
            <h2 class="font-semibold text-2xl text-[#3b3f5c]">
                Direktori Kontraktor
            </h2>
        </template>
        <div class="grid lg:grid-cols-3">
            <div class="lg:col-span-1">

                <div class="w-full max-w-full mb-4 bg-transparent">
                    <div class="grid grid-cols-1 gap-2">
                        <div class="relative flex-grow max-w-full flex-1 px-4">
                            <label class="required">Jenis</label>
                            <Multiselect
                                v-model="form.jenis"
                                label="value"
                                track-by="id"
                                :options="jenisOptions"
                                placeholder="Select one"
                                :disabled="form.processing"
                            >
                            </Multiselect>
                            <div
                                v-if="!form.jenis && form.errors.jenis"
                                class="text-red-600"
                            >
                                {{ form.errors.jenis }}
                            </div>
                        </div>
                        <div class="relative flex-grow max-w-full flex-1 px-4">
                            <label class="required">Negeri</label>
                            <multiselect
                                v-model="form.negeri"
                                :options="$page.props.negeriOption"
                                placeholder="Select one"
                                label="name"
                                track-by="id"
                                :disabled="form.processing"
                                @select="changeNegeri()"
                            >
                            </multiselect>
                            <div
                                v-if="!form.negeri && form.errors.negeri"
                                class="text-red-600"
                            >
                                {{ form.errors.negeri }}
                            </div>
                        </div>
                        <div class="relative flex-grow max-w-full flex-1 px-4">
                            <label class="required">PBT</label>
                            <multiselect
                                v-model="form.pbt"
                                :options="pbtOptions"
                                placeholder="Select one"
                                label="name"
                                track-by="id"
                                :disabled="form.processing"
                                @select="changePbt()"
                            >
                            </multiselect>
                            <div
                                v-if="!form.pbt && form.errors.pbt"
                                class="text-red-600"
                            >
                                {{ form.errors.pbt }}
                            </div>
                        </div>
                    </div>
                </div>

                <button
                    class="btn btn-primary rounded my-5"
                    title="cari"
                    type="button"
                    @click="search"
                >
                    <i class="bi bi-search" :disabled="form.processing"></i>
                    Cari
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

                <div
                    class="hidden lg:flex flex-col lg:flex-row mx-auto justify-center items-center mb-3"
                >
                    <div
                        class="max-w-xs  overflow-hidden grayscale hover:grayscale-0 hover:cursor-pointer"
                        :class="{ 'grayscale-0': form.jenis?.id == 'ICI' }"
                    >
                        <img
                            src="/public/Image/Logo1 edici.png"
                            class="w-full"
                            @click="
                                form.jenis = jenisOptions.find(
                                    (item) => item.id === 'ICI',
                                )
                            "
                        />
                    </div>
                    <div
                        class="max-w-xs  overflow-hidden grayscale hover:grayscale-0 hover:cursor-pointer grow"
                        :class="{ 'grayscale-0': form.jenis?.id == 'CND' }"
                    >
                        <img
                            src="/public/Image/logocwmsv2.png"
                            class="w-full"
                            @click="
                                form.jenis = jenisOptions.find(
                                    (item) => item.id === 'CND',
                                )
                            "
                        />
                    </div>
                </div>
            </div>
            <div class="lg:col-span-2">
                <div class="mt-4">
                    <div class="overflow-auto h-[500px] w-[350px] lg:w-full">
                        <div
                            v-if="form.processing"
                            class="w-12 h-12 -full animate-spin border-y border-solid border-yellow-500 border-t-transparent shadow-md mx-auto"
                        ></div>
                        <DataTable
                            v-else
                            :data="data"
                            class="display table"
                            :columns="columns"
                        >
                        </DataTable>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
