<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { router, usePage } from "@inertiajs/vue3";
import { usePaperizer } from "paperizer";
import FormSection from "@/Components/FormSection.vue";
import "vue-image-zoomer/dist/style.css";
import InputLabel from "@/Components/InputLabel.vue";
import VueEasyLightbox from "vue-easy-lightbox";
import { ref } from "vue";
import PrintMe from "./Partials/Print.vue";

defineProps({
    complaint: Object,
});

const imgsRef = ref([]);//ref([...usePage().props.complaint.lampiran?.map((v) => v.url)]);
const indexRef = ref(0);
const visibleRef = ref(false);
const onShow = (index) => {
    indexRef.value = index;
    visibleRef.value = true;
};
const onHide = () => (visibleRef.value = false);

const options = {
    name: "_blank",
    specs: ["fullscreen=yes", "titlebar=yes", "scrollbars=yes"],
    styles: [
        "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css",
        "https://unpkg.com/kidlat-css/css/kidlat.css",
    ],
    timeout: 1000, // default timeout before the print window appears
    autoClose: true, // if false, the window will not close after printing
    windowTitle: window.document.title, // override the window title
};

const { paperize } = usePaperizer("printMe", options);

const print = () => {
    paperize();
};
</script>

<template>
    <AppLayout title="Aduan">
        <template #header> </template>

        <PrintMe :complaint="complaint" />

        <FormSection>
            <template #title>
                <h2 class="font-semibold text-2xl text-[#3b3f5c]">
                    Aduan
                    <span
                        class="badge"
                        :class="{
                            'badge-success': complaint.status.id == 67,
                            'bg-blue-100': complaint.status.id == 64,
                            'bg-amber-100': complaint.status.id == 65,
                        }"
                        >{{ complaint.status.name }}
                    </span>
                </h2>
            </template>

            <template #description> </template>

            <template #form>
                <div class="col-span-12 sm:col-span-12">
                    <InputLabel for="park" class="font-bold"
                        >Nama Taman</InputLabel
                    >
                    <p>{{ complaint.park?.name }}</p>
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <InputLabel for="street" class="font-bold"
                        >Nama Jalan</InputLabel
                    >
                    <p>{{ complaint.street?.name }}</p>
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <InputLabel for="activity_code" class="font-bold"
                        >Kod Aktiviti</InputLabel
                    >
                    <p>{{ complaint.schedule?.activity_code }}</p>
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <InputLabel for="time_range" class="font-bold"
                        >Masa</InputLabel
                    >
                    <p>
                        {{ complaint.schedule?.time_start }} -
                        {{ complaint.schedule?.time_end }}
                    </p>
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <InputLabel for="date" class="font-bold">Tarikh</InputLabel>
                    <p>{{ complaint.schedule?.date }}</p>
                </div>

                <!-- Name -->
                <div class="col-span-12 sm:col-span-12">
                    <InputLabel
                        for="aduan"
                        value=" Keterangan Aduan"
                        class="required"
                    />
                    <p>{{ complaint.description }}</p>
                </div>

                <div class="col-span-12 sm:col-span-12">
                    <div class="grid grid-cols-3 overflow-auto">
                        <div
                            v-for="(img, idx) in complaint.lampiran"
                            :key="idx"
                            class="pic"
                            @click="() => onShow(idx)"
                        >
                            <img :src="img.url ? img.url : img" />
                        </div>
                        <vue-easy-lightbox
                            :visible="visibleRef"
                            :imgs="imgsRef"
                            :index="indexRef"
                            @hide="onHide"
                        />
                    </div>
                </div>
            </template>

            <template #actions>
                <button class="btn btn-md hidden" @click="print">
                    <i class="bi bi-printer"></i> Cetak
                </button>
                <button
                    v-if="complaint.status.id == 64"
                    class="btn btn-md btn-secondary hidden"
                    @click="
                        router.get(
                            route('complaint.edit', { complaint: complaint }),
                        )
                    "
                >
                    <i class="bi bi-pencil-square"></i> Kemaskini
                </button>
            </template>
        </FormSection>
    </AppLayout>
</template>

<style>
.gallery {
    max-width: 100%;
    display: flex;
    flex-wrap: wrap;
}

.pic {
    cursor: pointer;
    margin-right: 8px;
}
</style>
