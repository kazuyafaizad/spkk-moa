<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, router } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import DataTable from "datatables.net-vue3";
import DataTablesCore from "datatables.net";
import Select from "datatables.net-select";
import DataTablesLib from "datatables.net";
DataTable.use(DataTablesCore);
DataTable.use(Select);
DataTable.use(DataTablesLib);

let dt;
const table = ref();

onMounted(function () {
    dt = table.value.dt;

    dt.on("click", "tbody tr .lihat", function () {
        let data = dt.row(this.parentNode.parentNode).data();
        if (data.slug === "" || data.slug === null) {
            alert("Slugs is empty. Please update the slugs");
            return;
        }
        router.get(route("recipe.show", { recipe: data }));
    });

    dt.on("click", "tbody tr .kemaskini", function () {
        let data = dt.row(this.parentNode.parentNode).data();
        if (data.slug === "" || data.slug === null) {
            alert("Slugs is empty. Please update the slugs");
            return;
        }
        router.get(route("admin.recipe.edit", { recipe: data }));
    });
});

const columns = [
    { data: "title", title: "Tajuk" },
    { data: "description", title: "Keterangan" },
    {
        data: "status",
        title: "Status",
        render: function (data) {
            return data == true
                ? "<span class='text-success font-bold'>Aktif</span>"
                : "<span class='text-danger font-bold'>Tidak Aktif</span>";
        },
    },
    {
        data: "",
        title: "Tindakan",
        render: function () {
            let btn =
                '<div class="flex gap-2"><span class="lihat cursor-pointer text-primary" title="Lihat"><i class="bi bi-file-earmark-text shadow"></i></span>';
            btn +=
                '<span class="kemaskini cursor-pointer text-secondary" title="Kemaskini"><i class="bi bi-pencil-square shadow"></i> </span>';
            btn += "</div>";
            return btn;
        },
    },
];
</script>

<template>
    <AppLayout title="Admin">
        <template #header>
            <h2 class="font-semibold text-2xl text-[#3b3f5c]">Discover More</h2>
        </template>

        <div>
            <div class="w-full max-w-full mb-4 bg-transparent">
                <h2 class="text-lg font-semibold">Tindakan Saya</h2>
                <p class="text-sm text-gray-500">
                    Klik pada senarai untuk tindakan tambahan
                </p>
                <div class="flex gap-2 my-2">
                    <Link
                        v-if="
                            $page.props.auth.user?.role_id === 2 ||
                            $page.props.auth.user?.role_id === 17
                        "
                        class="btn btn-primary rounded"
                        :href="route('admin.recipe.create')"
                        as="button"
                        ><i class="bi bi-plus-circle-fill"></i> Tambah</Link
                    >
                </div>
                <div class="overflow-auto">
                    <DataTable
                        ref="table"
                        :data="$page.props.recipe.data"
                        class="display table w-full"
                        :columns="columns"
                        :options="{ select: false }"
                    ></DataTable>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
