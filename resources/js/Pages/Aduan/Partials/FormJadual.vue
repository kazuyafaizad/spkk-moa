<script setup>
import { onMounted, ref, onBeforeMount } from "vue";
import { useForm, router, usePage } from "@inertiajs/vue3";
import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net";
import "datatables.net-select";
import { Multiselect } from "vue-multiselect";

DataTable.use(DataTablesCore);

let dt;
const table = ref();
const oData = ref(usePage().props.jadual);

onMounted(function () {
    dt = table.value.dt;
    dt.on("click", "tbody tr .sel", function () {
        let data = dt.row(this.parentNode.parentNode).data();
        router.get(route("complaint.create"), {
            data: data,
        });
    });
});
const props = defineProps({
    filters: Object,
});

const form = useForm({
    schedule_type: props.filters.schedule_type,
    aktiviti: props.filters.aktiviti,
    negeri: props.filters.negeri,
    pbt: props.filters.pbt,
    taman: props.filters.taman,
    jalan: props.filters.jalan,
});

const jenisJadualOptions = ref([
    { id: 1, name: "Kutipan" },
    { id: 2, name: "Pembersihan Awam" },
]);
const aktivitiOptions = ref([
    {
        name: "",
        id: "",
    },
]);

const pbtOptions = ref([
    {
        name: "",
        id: "",
    },
]);

const tamanOptions = ref([
    {
        name: "",
        id: "",
    },
]);

const jalanOptions = ref([
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

const changeTaman = async () => {
    await axios
        .get("/taman/" + form.pbt.id)
        .then((response) => (tamanOptions.value = response.data));
};

const changeJalan = async () => {
    await axios
        .get("/jalan/" + form.taman.id)
        .then((response) => (jalanOptions.value = response.data));
};
const changeActivity = async () => {
    await axios
        .get("/activities/" + form.schedule_type.id)
        .then((response) => (aktivitiOptions.value = response.data));
};

onBeforeMount(() => {
    if (form.negeri) {
        changeNegeri(), changeTaman(), changeJalan(), changeActivity();
    }
});

const columns = [
    { data: "jadual_id", title: "Jadual ID" },
    { data: "street_name", title: "Jalan" },
    { data: "activity.keterangan", title: "Aktiviti" },
    { data: "date", title: "Tarikh" },
    { data: "time_start", title: "Mula" },
    { data: "time_end", title: "Tamat" },
    {
        data: "",
        title: "Tindakan",
        render: function () {
            return '<div class="flex gap-2"><span class=" cursor-pointer text-danger sel" title="Laporkan Aduan"><i class="bi bi-check2-square shadow"></i> Laporkan Aduan</span></div>';
        },
    },
];

const showNoJadual = ref(false);

const search = () => {
    form.clearErrors();
    form.processing = true;

    // if(form.aktiviti === null)
    // {
    //     form.setError('aktiviti', 'Sila pilih Aktiviti');
    // }

    if (form.negeri === null) {
        form.setError("negeri", "Sila pilih Negeri");
    }

    if (form.pbt === null) {
        form.setError("pbt", "Sila pilih PBT");
    }
    if (form.taman === null) {
        form.setError("taman", "Sila pilih Taman");
    }

    if (!form.hasErrors) {
        router.get(route("complaint.schedule", form), {
            preserveState: true,
            only: ["jadual"],
            onSuccess: () => {
                form.processing = false;
                oData.value = usePage().props.jadual;

                // if(usePage().props.jadual.length == 0){
                //     showNoJadual.value = true;
                // }else{
                //     showNoJadual.value = false;
                // }
            },
        });
    } else {
        form.processing = false;
    }
};

const resetForm = () => {
    Object.keys(form.data()).forEach((field) => form.defaults(field, null));
    form.reset();
};
</script>

<template>
    <div class="md:col-span-1 flex justify-between">
        <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium text-gray-900">Carian Jadual</h3>
        </div>
        <!-- {{ form }} -->
    </div>
    <div class="w-full max-w-full mb-4 bg-transparent">
        <div class="grid lg:grid-cols-2 gap-2">
            <div class="relative flex-grow max-w-full flex-1 px-4">
                <label class="required">Pilih Jenis Jadual</label>
                <Multiselect
                    v-model="form.schedule_type"
                    :options="jenisJadualOptions"
                    placeholder="Sila Pilih"
                    :disabled="form.processing"
                    label="name"
                    track-by="id"
                    @select="changeActivity()"
                >
                </Multiselect>
                <div v-if="form.errors.schedule_type" class="text-red-600">
                    {{ form.errors.schedule_type }}
                </div>
            </div>

            <div class="relative flex-grow max-w-full flex-1 px-4">
                <label>Pilih Aktiviti</label>
                <Multiselect
                    v-model="form.aktiviti"
                    :options="aktivitiOptions"
                    placeholder="Sila Pilih"
                    :disabled="form.processing"
                    label="name"
                    track-by="kod_aktiviti"
                >
                </Multiselect>
                <div v-if="form.errors.aktiviti" class="text-red-600">
                    {{ form.errors.aktiviti }}
                </div>
            </div>
            <div class="relative flex-grow max-w-full flex-1 px-4">
                <label class="required">Pilih Negeri</label>
                <multiselect
                    v-model="form.negeri"
                    :options="$page.props.negeriOption"
                    placeholder="Sila Pilih"
                    label="name"
                    track-by="id"
                    @select="changeNegeri()"
                >
                </multiselect>
                <div v-if="form.errors.negeri" class="text-red-600">
                    {{ form.errors.negeri }}
                </div>
            </div>
            <div class="relative flex-grow max-w-full flex-1 px-4">
                <label class="required">Pilih PBT</label>
                <multiselect
                    v-model="form.pbt"
                    :options="pbtOptions"
                    placeholder="Sila Pilih"
                    label="name"
                    track-by="id"
                    @select="changeTaman()"
                >
                </multiselect>
                <div v-if="form.errors.pbt && !form.pbt" class="text-red-600">
                    {{ form.errors.pbt }}
                </div>
            </div>
            <div class="relative flex-grow max-w-full flex-1 px-4">
                <label class="required">Pilih Taman</label>
                <multiselect
                    v-model="form.taman"
                    :options="tamanOptions"
                    placeholder="Sila Pilih"
                    label="name"
                    track-by="id"
                    @select="changeJalan()"
                >
                </multiselect>
                <div
                    v-if="form.errors.taman && !form.taman"
                    class="text-red-600"
                >
                    {{ form.errors.taman }}
                </div>
            </div>
            <div class="relative flex-grow max-w-full flex-1 px-4">
                <label>Pilih Jalan</label>
                <multiselect
                    v-model="form.jalan"
                    :options="jalanOptions"
                    placeholder="Sila Pilih"
                    label="name"
                    track-by="id"
                >
                </multiselect>
            </div>
        </div>
    </div>
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
    <div >
        <h2 class="text-lg font-semibold">Tindakan Saya</h2>
        <p class="text-sm text-gray-500">
            Klik pada jadual yang ingin diadukan
        </p>
        <template v-if="!showNoJadual">
            <div class="overflow-auto">
                <div
                    v-if="form.processing"
                    class="w-12 h-12 rounded-full animate-spin border-y border-solid border-yellow-500 border-t-transparent shadow-md mx-auto"
                ></div>
                <DataTable
                    v-else
                    ref="table"
                    :data="oData"
                    class="display table"
                    :columns="columns"
                    :options="{ select: false }"
                >
                </DataTable>
            </div>
        </template>
        <template v-if="showNoJadual">
            <div class="flex justify-center flex-col text-center gap-4">
                <span class="text-red-500 text-1xl"
                    >Tiada Jadual Dijumpai<br /><i
                        >(Aduan hanya dibenarkan sekiranya ada jadual)</i
                    ></span
                >
            </div>
        </template>
    </div>
</template>
