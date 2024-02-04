<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { ref, onMounted } from "vue";
import { usePage, Link } from "@inertiajs/vue3";
import DialogModal from "@/Components/DialogModal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";


const showAnnouncement = ref(false);

const closeModal = () => {
    localStorage.setItem("popupClosed", new Date().toDateString());
    showAnnouncement.value = false;
};

const checkURL = (url) => {
    const urlRegex = /^(https?|ftp):\/\/[^\s/$.?#].[^\s]*$/i;
    return urlRegex.test(url);
};

onMounted(() => {
    const lastClosed = localStorage.getItem("popupClosed");
    if (
        !lastClosed ||
        (lastClosed !== new Date().toDateString() &&
            usePage().props.announcement)
    ) {
        showAnnouncement.value = true;
    }
});
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header> </template>

        <DialogModal :show="showAnnouncement" @close="closeModal">
            <template #title> PENGUMUMAN </template>

            <template #content>
                <template v-if="$page.props.announcement">
                    <img
                        :src="
                            checkURL($page.props.announcement.image)
                                ? $page.props.announcement.image
                                : '/' + $page.props.announcement.image
                        "
                        class="w-full max-w-lg mx-auto"
                    />
                </template>
            </template>

            <template #footer>
                <SecondaryButton @click="closeModal"> Tutup </SecondaryButton>
            </template>
        </DialogModal>

        <div
            class="grid md:grid-cols-2 lg:grid-cols-3 max-w-screen-xl mx-auto gap-10 mt-5 px-3 lg:px-5"
        >
            <Link
                :href="route('complaint.index')"
                class="overflow-hidden shadow-lg flex-1 bg-white sm:mx-2 md:mx-1 lg:mx-2 w-full lg:pt-0 border-b-4 border-[#38a3a5] mb-10 flex flex-col transform transition duration-500 hover:scale-110"
            >
                <img
                    src="https://www.scanlanspropertymanagement.com/wp-content/uploads/gergheer.jpg"
                    alt="People"
                    class="w-full object-contain h-32 sm:h-48 md:h-64"
                />
                <div class="p-4 md:p-6 bg-white flex flex-col flex-1">
                    <p
                        class="text-[#38a3a5] font-semibold text-xs mb-1 leading-none"
                    >
                        Aduan
                    </p>
                    <ul class="list-disc list-inside flex-1">
                        <li>Aduan kepada Pihak Berkuasa Tempatan</li>
                        <li>Aduan mengikut jadual</li>
                        <li>Aduan tanpa jadual</li>
                    </ul>
                </div>
            </Link>

            <Link
                :href="route('jadual.index')"
                class="overflow-hidden shadow-lg flex-1 bg-white sm:mx-2 md:mx-1 lg:mx-2 w-full lg:pt-0 border-b-4 border-[#38a3a5] mb-10 flex flex-col transform transition duration-500 hover:scale-110"
            >
                <img
                    src="https://rockingham.wa.gov.au/CityOfRockingham/media/Images/Your%20Services/Waste%20and%20recycling/Bin-collection-week.jpg"
                    alt="Tong Sampah Kitar Semula"
                    class="w-full object-contain h-32 sm:h-48 md:h-64"
                />
                <div class="p-4 md:p-6 bg-white flex flex-col flex-1">
                    <p
                        class="text-[#38a3a5] font-semibold text-xs mb-1 leading-none"
                    >
                        Jadual Perkhidmatan Kutipan & Pembersihan
                    </p>
                    <ul class="list-disc list-inside flex-1">
                        <li>
                            Carian Jadual pembersihan dan kutipan pada ketetapan
                            pengguna
                        </li>
                        <li>Semakan pada tarikh tertentu</li>
                        <li>Carian Negeri, PBT, Taman</li>
                    </ul>
                </div>
            </Link>

            <Link
                :href="route('sisaindustri.index')"
                class="overflow-hidden shadow-lg flex-1 bg-white sm:mx-2 md:mx-1 lg:mx-2 w-full lg:pt-0 border-b-4 border-[#38a3a5] mb-10 flex flex-col transform transition duration-500 hover:scale-110"
            >
                <img
                    src="https://media.istockphoto.com/id/1273295329/video/recycling-factory-worker-sorts-garbage-into-a-pile.jpg?s=640x640&k=20&c=16piT9H5yzhWS2JCaGxLvWQO8FSPKJp8sFSBWGZ1SEo="
                    alt="syarikat pengumpulan sisa"
                    class="w-full object-contain h-32 sm:h-48 md:h-64"
                />
                <div class="p-4 md:p-6 bg-white flex flex-col flex-1">
                    <h3 class="text-[#38a3a5] font-semibold text-xl mb-2">
                        Direktori Kontraktor
                    </h3>
                    <ul class="list-disc list-inside flex-1">
                        <li>
                            Senarai Syarikat yang mengendalikan sisa bagi
                            industri/pembinaan
                        </li>
                        <li>Carian Syarikat mengikut tempat</li>
                    </ul>
                </div>
            </Link>

            <Link
                :href="route('kitarsemula.index')"
                class="overflow-hidden shadow-lg flex-1 bg-white sm:mx-2 md:mx-1 lg:mx-2 w-full lg:pt-0 border-b-4 border-[#38a3a5] mb-10 flex flex-col transform transition duration-500 hover:scale-110"
            >
                <img
                    src="https://environment.co/wp-content/uploads/sites/4/2021/10/decoding-Americas-recycle-symbol.jpg"
                    alt="logo kitar semula"
                    class="w-full object-contain h-32 sm:h-48 md:h-64"
                />
                <div class="p-4 md:p-6 bg-white flex flex-col flex-1">
                    <h3 class="text-[#38a3a5] font-semibold text-xl mb-2">
                        Kemudahan Kitar Semula
                    </h3>
                    <ul class="list-disc list-inside flex-1">
                        <li>
                            Memudahkan pencarian kemudahan kitar semula di
                            kawasan pengguna
                        </li>
                    </ul>
                </div>
            </Link>

            <Link
                :href="route('recipe.index')"
                class="overflow-hidden shadow-lg flex-1 bg-white sm:mx-2 md:mx-1 lg:mx-2 w-full lg:pt-0 border-b-4 border-[#38a3a5] mb-10 flex flex-col transform transition duration-500 hover:scale-110"
            >
                <img
                    src="https://static.onecms.io/wp-content/uploads/sites/19/2019/01/15/bbqchickendip-2000.jpg"
                    alt="Recipe"
                    class="w-full object-contain h-32 sm:h-48 md:h-64"
                />
                <div class="p-4 md:p-6 bg-white flex flex-col flex-1">
                    <h3 class="text-[#38a3a5] font-semibold text-xl mb-2">
                        Discover More
                    </h3>
                    <ul class="list-disc list-inside flex-1">
                        <li>Panduan dan resepi Guna semula (leftover)</li>
                    </ul>
                </div>
            </Link>
        </div>

        <div class="grid max-w-screen-xl mx-auto gap-10 mt-16 px-5">
            <h3 class="text-2xl">Pengumuman Awam</h3>
            <template v-if="$page.props.announcement">
                <img
                    :src="
                        checkURL($page.props.announcement.image)
                            ? $page.props.announcement.image
                            : '/' + $page.props.announcement.image
                    "
                    class="w-full max-w-lg mx-auto"
                    :alt="$page.props.announcement.content"
                />
            </template>
        </div>
    </AppLayout>
</template>

<style>
.swiper {
  width: 600px;
  height: 300px;
}
</style>
