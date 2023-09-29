<script setup>
import { ref } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link, router, useForm } from '@inertiajs/vue3';
import DialogModal from '@/Components/DialogModal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';


const displayingToken = ref(false);
const photoPreview = ref(null);
const photoInput = ref(null);

const selectNewPhoto = () => {
    photoInput.value.click();
};



const form = useForm({
    title: "",
    description: "",
    image: null,
});

const updateProfileInformation = () => {
    if (photoInput.value) {
        form.image = photoInput.value.files[0];
    }

    form.post(route(''), {
        errorBag: 'updateProfileInformation',
        preserveScroll: true,
        onSuccess: () => clearPhotoFileInput(),
    });
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (! photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};


</script>

<template>
    <AppLayout title="Resepi Leftover">

        <template #header>
            <h2 class="font-semibold text-2xl  text-[#3b3f5c]">
                Resepi Leftover
            </h2>
        </template>

        <div class="w-full max-w-full mb-4 bg-transparent">
            <div class="my-4">
                <Link class="btn btn-primary rounded my-4"  :href="route('resepileftover.admin')" as="button">Tambah Resipi</Link>
                <button class="btn btn-primary rounded my-4"  >Post saya</button>
                <form class="form-inline search-full form-inline search" role="search">
                            <div class="search-bar">
                                <input type="text" class="form-control search-form-control  ml-lg-auto" placeholder="Cari...">
                            </div>
                        </form>
            </div>

            <div class="grid grid-cols-4 gap-2">
                <div v-for="(r, i) in $page.props.resepi" :key="i">
                    <div class=" rounded overflow-hidden shadow-lg">
                        <img class="w-full" :src="r.image" alt="Sunset in the mountains">
                        <div class="px-6 py-4">
                            <div class="font-bold text-xl mb-2">{{ r.title }}</div>
                            <p class="text-gray-700 text-base">
                               {{ r.description }}
                            </p>
                        </div>
                        <!-- <div class="px-6 pt-4 pb-2">
                            <span
                                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
                            <span
                                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
                            <span
                                class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span>
                        </div> -->
                    </div>
                </div>
            </div>

        </div>
    </AppLayout>
</template>
