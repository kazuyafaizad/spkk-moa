<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, router, usePage } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net";
import "datatables.net-select";

let dt;

DataTable.use(DataTablesCore);

const table = ref();
const showKemaskini = ref(false);
const showLihat = ref(false);
const currentComplaint = ref();
const oData = ref(usePage().props.my_complaints);

defineProps({
    totalAduan: { default: 0, type: Number },
    aduanBaru: { default: 0, type: Number },
    aduanAktif: { default: 0, type: Number },
    aduanSelesai: { default: 0, type: Number },
    aduanTolak: { default: 0, type: Number },
});

onMounted(function () {
    dt = table.value.dt;

    dt.on("click", "tbody tr .lihat", function () {
        let data = dt.row(this.parentNode.parentNode).data();
        currentComplaint.value = data.btoa;
        router.get(
            route("complaint.show", { complaint: currentComplaint.value }),
        );
    });

    dt.on("click", "tbody tr .kemaskini", function () {
        let data = dt.row(this.parentNode.parentNode).data();
        currentComplaint.value = data.btoa;
        router.get(
            route("complaint.edit", { complaint: currentComplaint.value }),
        );
    });
});

const columns = [
    { data: "running_no", title: "No. Rujukan" },
    { data: "created_at", title: "Tarikh Aduan" },
    { data: "pbt.name", title: "PBT" },
    { data: "street.name", title: "Jalan" },
    {
        data: "status",
        title: "Status",
        render: function (data) {
            switch (data.id) {
                case 64:
                    return `<span class="badge bg-blue-100">${data.name}</span>`;
                case 65:
                    return `<span class="badge bg-amber-100">${data.name}</span>`;
                case 66:
                    return `<span class="badge bg-green-100">${data.name}</span>`;
                case 67:
                    return `<span class="badge bg-red-100">${data.name}</span>`;
                default:
                    break;
            }
        },
    },
    {
        data: "status",
        title: "Tindakan",
        render: function (data) {
            let btn =
                '<div class="flex gap-2"><span class="lihat cursor-pointer text-primary" title="Lihat"><i class="bi bi-file-earmark-text shadow"></i></span>';
            btn +=
                data.id == 64
                    ? '<span class="kemaskini cursor-pointer text-secondary" title="Kemaskini"><i class="bi bi-pencil-square shadow"></i> </span>'
                    : "";
            btn += "</div>";
            return btn;
        },
    },
];

const filterActive = () => {
    oData.value = usePage().props.my_complaints.filter(
        (i) => i.status_id == 65,
    );
};
const filterBaru = () => {
    oData.value = usePage().props.my_complaints.filter(
        (i) => i.status_id == 64,
    );
};
const filterAll = () => {
    oData.value = usePage().props.my_complaints;
};

const filterSelesai = () => {
    oData.value = usePage().props.my_complaints.filter(
        (i) => i.status_id == 66,
    );
};
const filterTolak = () => {
    oData.value = usePage().props.my_complaints.filter(
        (i) => i.status_id == 67,
    );
};
</script>

<template>
    <AppLayout title="Aduan">
        <template #header>
            <h2 class="font-semibold text-2xl text-[#3b3f5c]">Aduan</h2>
        </template>

        <div class="w-full max-w-full mb-4 bg-transparent">
            <section class="grid md:grid-cols-2 xl:grid-cols-5 gap-2">
                <div
                    style="border-color: #38a3a5 !important"
                    class="flex items-center p-8 bg-white cursor-pointer hover:bg-green-400/40 transition"
                    @click="filterBaru"
                >
                    <div
                        class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-blue-600 bg-blue-100 rounded-full mr-6"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="currentColor"
                            class="bi bi-circle h-6 w-6"
                            viewBox="0 0 16 16"
                        >
                            <path
                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"
                            />
                        </svg>
                    </div>
                    <div>
                        <span class="block text-2xl font-bold">{{
                            aduanBaru
                        }}</span>
                        <span class="block">Baru</span>
                    </div>
                </div>
                <div
                    style="border-color: #38a3a5 !important"
                    class="flex items-center p-8 bg-white cursor-pointer hover:bg-green-400/40 transition"
                    @click="filterActive"
                >
                    <div
                        class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-amber-600 bg-amber-100 rounded-full mr-6"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="currentColor"
                            class="bi bi-stopwatch h-6 w-6"
                            viewBox="0 0 16 16"
                        >
                            <path
                                d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5z"
                            />
                            <path
                                d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64a.715.715 0 0 1 .012-.013l.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354a.512.512 0 0 1-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5M8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3"
                            />
                        </svg>
                    </div>
                    <div>
                        <span class="block text-2xl font-bold">{{
                            aduanAktif
                        }}</span>
                        <span class="block">Dalam Tindakan</span>
                    </div>
                </div>
                <div
                    style="border-color: #38a3a5 !important"
                    class="flex items-center p-8 bg-white cursor-pointer hover:bg-green-400/40 transition"
                    @click="filterTolak"
                >
                    <div
                        class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-red-600 bg-red-100 rounded-full mr-6"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="currentColor"
                            class="bi bi-x-circle h-6 w-6"
                            viewBox="0 0 16 16"
                        >
                            <path
                                d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"
                            />
                            <path
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"
                            />
                        </svg>
                    </div>
                    <div>
                        <span class="block text-2xl font-bold">{{
                            aduanTolak
                        }}</span>
                        <span class="block">Tolak</span>
                    </div>
                </div>
                <div
                    style="border-color: #38a3a5 !important"
                    class="flex items-center p-8 bg-white cursor-pointer hover:bg-green-400/40 transition"
                    @click="filterSelesai"
                >
                    <div
                        class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-green-600 bg-green-100 rounded-full mr-6"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="currentColor"
                            class="bi bi-check-circle-fill h-6 w-6"
                            viewBox="0 0 16 16"
                        >
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"
                            />
                        </svg>
                    </div>
                    <div>
                        <span class="inline-block text-2xl font-bold">{{
                            aduanSelesai
                        }}</span>
                        <span class="block">Selesai</span>
                    </div>
                </div>
                <div
                    style="border-color: #38a3a5 !important"
                    class="flex items-center p-8 bg-white cursor-pointer hover:bg-green-400/40 transition"
                    @click="filterAll"
                >
                    <div
                        class="inline-flex flex-shrink-0 items-center justify-center h-16 w-16 text-purple-600 bg-purple-100 rounded-full mr-6"
                    >
                        <svg
                            aria-hidden="true"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            class="h-6 w-6"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                            />
                        </svg>
                    </div>
                    <div>
                        <span class="block text-2xl font-bold">{{
                            totalAduan
                        }}</span>
                        <span class="block">Jumlah Aduan</span>
                    </div>
                </div>
            </section>

            <section>
                <h2 class="text-lg font-semibold">Tindakan Saya</h2>
                <p class="text-sm text-gray-500">
                    Klik pada senarai untuk tindakan tambahan
                </p>
                <div class="flex gap-4">
                    <Link
                        class="btn btn-danger rounded text-2xl flex justify-center gap-2 my-4"
                        :href="route('complaint.schedule')"
                        as="button"
                    >
                        <span class="text-lg"
                            ><i class="bi bi-flag-fill"></i> Laporkan
                            Aduan</span
                        >
                    </Link>
                    <Link
                        v-if="showLihat"
                        class="btn btn-primary rounded text-2xl flex justify-center gap-2 my-4"
                        :href="
                            route('complaint.show', {
                                complaint: currentComplaint,
                            })
                        "
                        as="button"
                    >
                        <span class="text-lg"
                            ><i class="bi bi-check2-square"></i> Lihat</span
                        >
                    </Link>
                    <Link
                        v-if="showKemaskini"
                        class="btn btn-secondary rounded text-2xl flex justify-center gap-2 my-4"
                        :href="
                            route('complaint.edit', {
                                complaint: currentComplaint,
                            })
                        "
                        as="button"
                    >
                        <span class="text-lg"
                            ><i class="bi bi-pencil-square"></i> Kemaskini</span
                        >
                    </Link>
                </div>
                <div class="overflow-auto">
                    <DataTable
                        ref="table"
                        :data="oData"
                        class="table display"
                        :options="{
                            select: false,
                            order: [[4, 'asc']],
                        }"
                        :columns="columns"
                    >
                    </DataTable>
                </div>
            </section>
        </div>
    </AppLayout>
</template>
