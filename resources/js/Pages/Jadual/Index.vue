<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { ref, onBeforeMount } from "vue";
import { useForm, router } from "@inertiajs/vue3";
import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net";
import { Multiselect } from "vue-multiselect";
import NegeriAkta from "@/Components/NegeriAkta.vue";
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

DataTable.use(DataTablesCore);

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
    tarikh: props.filters.tarikh,
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
    { data: "park_name", title: "Taman" },
    { data: "street_name", title: "Jalan" },
    {
        data: "activity.keterangan",
        title: "Aktiviti",
        render: function (data, type, row) {
            if (row.activity_code === "KB") {
                return "SISA PUKAL/SISA TAMAN/ SISA KITAR SEMULA";
            } else {
                return data;
            }
        },
    },
    { data: "date", title: "Tarikh" },
    { data: "time_start", title: "Mula" },
    { data: "time_end", title: "Tamat" },
];

const search = () => {
    form.processing = true;
    form.clearErrors();

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
        router.visit(route("jadual.index", form), {
            preserveState: true,
            only: ["jadual"],
            onFinish: () => {
                form.processing = false;
            },
        });
    } else {
        form.processing = false;
    }
};

// Get the current date
const currentDate = new Date();

const firstDayOfMonth = new Date(
    currentDate.getFullYear(),
    currentDate.getMonth(),
    1,
);
const lastDayOfMonth = new Date(
    currentDate.getFullYear(),
    currentDate.getMonth() + 1,
    0,
);

const resetForm = () => {
    Object.keys(form.data()).forEach((field) => form.defaults(field, null));
    form.reset();
};
</script>

<template>
    <AppLayout title="Jadual Kutipan/Pembersihan">
        <template #header>
            <h2 class="font-semibold text-2xl text-[#3b3f5c]">
                Semakan Jadual Perkhidmatan
            </h2>
        </template>
        <div class="grid grid-cols-3">
            <NegeriAkta class="hidden lg:block col-span-2" />

            <div
                class="w-full max-w-full my-4 bg-transparent text-[#3b3f5c] hidden lg:block text-sm"
            >
                <p>
                    <b
                        >PERKHIDMATAN PENGURUSAN SISA PEPEJAL DAN PEMBERSIHAN
                        AWAM</b
                    >
                </p>
                <p class="text-[#3b3f5c]">
                    Memastikan Syarikat Konsesi melaksanakan perkhidmatan
                    kutipan sisa pepejal dan pembersihan awam di negeri-negeri
                    yang menerima pakai Akta 672 mengikut jadual yang
                    ditetapkan:
                </p>
                <ul
                    style="list-style-type: circle; list-style-position: inside"
                >
                    <li>
                        Sisa domestik dipungut sekurang-kurangnya 2 kali
                        seminggu dan sisa pukal/taman/kitar semula dikutip 1
                        kali seminggu;
                    </li>
                    <li>Rumput dipotong 2 kali sebulan;</li>
                    <li>
                        Longkang awam dibersihkan 1 kali sebulan kecuali
                        longkang tanah; dan
                    </li>
                    <li>
                        Jalan protokol, jejantas, jejambat dan terowong
                        dibersihkan setiap hari, jalan utama dan komersial 6
                        kali seminggu dan jalan industri 1 kali sebulan.
                    </li>
                </ul>
            </div>
        </div>

        <div class="w-full max-w-full mb-4 bg-transparent">
            <div class="grid lg:grid-cols-4 gap-2">
                <div class="relative flex-grow max-w-full flex-1 px-4">
                    <label for="jenis_jadual">Pilih Jenis Jadual</label>
                    <Multiselect
                        id="jenis_jadual"
                        v-model="form.schedule_type"
                        :options="jenisJadualOptions"
                        placeholder="Sila Pilih"
                        :disabled="form.processing"
                        label="name"
                        track-by="id"
                        aria-label="jenis_jadual"
                        @select="changeActivity()"
                    >
                    </Multiselect>
                    <div v-if="form.errors.schedule_type" class="text-red-600">
                        {{ form.errors.schedule_type }}
                    </div>
                </div>

                <div class="relative flex-grow max-w-full flex-1 px-4">
                    <label for="aktiviti">Pilih Aktiviti</label>
                    <Multiselect
                        id="aktiviti"
                        v-model="form.aktiviti"
                        :options="aktivitiOptions"
                        placeholder="Sila Pilih"
                        :disabled="form.processing"
                        label="name"
                        track-by="kod_aktiviti"
                        aria-label="aktiviti"
                    >
                    </Multiselect>
                    <div v-if="form.errors.aktiviti" class="text-red-600">
                        {{ form.errors.aktiviti }}
                    </div>
                </div>
                <div class="relative flex-grow max-w-full flex-1 px-4">
                    <label class="required" for="negeri">Pilih Negeri</label>
                    <multiselect
                        id="negeri"
                        v-model="form.negeri"
                        :options="$page.props.negeriOption"
                        placeholder="Sila Pilih"
                        label="name"
                        track-by="id"
                        :disabled="form.processing"
                        aria-label="negeri"
                        @select="changeNegeri()"
                    >
                    </multiselect>
                    <div v-if="form.errors.negeri" class="text-red-600">
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
                        :disabled="form.processing"
                        aria-label="pbt"
                        @select="changeTaman()"
                    >
                    </multiselect>
                    <div v-if="form.errors.pbt" class="text-red-600">
                        {{ form.errors.pbt }}
                    </div>
                </div>
                <div class="relative flex-grow max-w-full flex-1 px-4">
                    <label class="required" for="taman">Pilih Taman</label>
                    <multiselect
                        id="taman"
                        v-model="form.taman"
                        :options="tamanOptions"
                        placeholder="Sila Pilih"
                        label="name"
                        track-by="id"
                        :disabled="form.processing"
                        aria-label="taman"
                        @select="changeJalan()"
                    >
                    </multiselect>
                    <div v-if="form.errors.taman" class="text-red-600">
                        {{ form.errors.taman }}
                    </div>
                </div>
                <div class="relative flex-grow max-w-full flex-1 px-4">
                    <label for="jalan">Pilih Jalan</label>
                    <multiselect
                        id="jalan"
                        v-model="form.jalan"
                        :options="jalanOptions"
                        placeholder="Sila Pilih"
                        label="name"
                        track-by="id"
                        :disabled="form.processing"
                        aria-label="jalan"
                    >
                    </multiselect>
                </div>
                <div class="relative flex-grow max-w-full flex-1 px-4">
                    <label for="tarikh">Pilih Tarikh</label>
                    <VueDatePicker
                        id="tarikh"
                        v-model="form.tarikh"
                        class="multiselect__input"
                        :disabled="form.processing"
                        range
                        :partial-range="false"
                        :enable-time-picker="false"
                        :min-date="firstDayOfMonth"
                        :max-date="lastDayOfMonth"
                    >
                    </VueDatePicker>
                    <div v-if="form.errors.tarikh" class="text-red-600">
                        {{ form.errors.tarikh }}
                    </div>
                </div>
            </div>
        </div>

        <!-- <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline text-blue-600 border-blue-600 hover:bg-blue-600 hover:text-white bg-white hover:bg-blue-600 mb-2">Primary</button> -->
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
                <DataTable
                    v-else
                    :data="$page.props.jadual"
                    class="display table"
                    :columns="columns"
                    aria-label="Table Jadual"
                >
                </DataTable>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.dp__theme_light {
    --dp-border-color: #000;
}
</style>
