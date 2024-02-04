<script setup>
import { ref, onMounted } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";

import ActionMessage from "@/Components/ActionMessage.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import FormSection from "@/Components/FormSection.vue";

const props = defineProps({
    complaint: Object,
});

const imagePreviews = ref(null);
const imageInput = ref(null);

const form = useForm({
    description: props.complaint.description,
    lampiran_aduan: props.complaint.lampiran,
    id: props.complaint.id,
});

const updateAduan = () => {
    form.post(route("complaint.update", { complaint: props.complaint.btoa }), {
        preserveScroll: true,
        onSuccess: () => clearImageFileInput(),
    });
};

const selectNewImage = () => {
    imageInput.value.click();
};

const updateImagePreviews = () => {
    const currentImages = form.lampiran_aduan || [];
    const newImages = imageInput.value.files;

    const allImages = [...currentImages, ...Array.from(newImages)];

    const newPreviews = allImages.map((image) => {
        return new Promise((resolve) => {
            if (image instanceof File) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    resolve(e.target.result);
                };
                reader.readAsDataURL(image);
            } else {
                // If it's not a File object, resolve with the image URL directly
                resolve(image.url);
            }
        });
    });

    Promise.all(newPreviews).then((previews) => {
        form.lampiran_aduan = allImages;
        imagePreviews.value = previews;
    });
};

onMounted(() => {
    imagePreviews.value = form.lampiran_aduan.map((item) => item.url);
});

const deleteImage = (index) => {
    if (form.lampiran_aduan.length > 0) {
        form.lampiran_aduan.splice(index, 1);
        imagePreviews.value.splice(index, 1);
    }
};

const clearImageFileInput = () => {
    if (imageInput.value?.value) {
        imageInput.value.value = null;
    }
};
</script>

<template>
    <AppLayout>
        <div class="md:col-span-1 flex justify-between"></div>

        <FormSection @submitted="updateAduan">
            <template #title>
                <h2 class="font-semibold text-2xl text-[#3b3f5c]">
                    Kemaskini Aduan
                    <span class="text-secondary">{{
                        complaint.running_no
                    }}</span>
                </h2>
            </template>

            <template #description>
                Pengadu dinasihatkan membuat keterangan yang terperinci supaya
                tindakan lebih mudah dilaksanakan. Pengadu juga hendaklah
                sediakan tiga(3) gambar sebagai lampiran untuk dimuat naik
            </template>

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

                <div class="col-span-12 sm:col-span-12">
                    <InputLabel
                        for="aduan"
                        value=" Keterangan Aduan"
                        class="required"
                    />
                    <textarea
                        id="aduan"
                        v-model="form.description"
                        class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"
                        rows="15"
                        placeholder="Masukkan keterangan aduan"
                    ></textarea>
                    <InputError
                        v-if="form.errors.description && !form.description"
                        :message="form.errors.description"
                        class="mt-2"
                    />
                </div>

                <div class="col-span-12 sm:col-span-12">
                    <input
                        ref="imageInput"
                        type="file"
                        accept="image/*"
                        class="hidden"
                        multiple="multiple"
                        @change="updateImagePreviews"
                    />

                    <InputLabel for="image" value="Lampiran" class="required" />

                    <div class="grid grid-cols-1 overflow-auto">
                        <div
                            v-for="(preview, index) in imagePreviews"
                            :key="index"
                            class="mt-2 flex gap-2"
                        >
                            <span
                                class="block w-72 h-72 bg-cover bg-no-repeat bg-center"
                                :style="
                                    'background-image: url(\'' +
                                    preview +
                                    '\');'
                                "
                            />
                            <div class="mt-2" @click="() => deleteImage(index)">
                                <i class="bi bi-trash text-2xl"></i>
                            </div>
                        </div>
                    </div>
                    <SecondaryButton
                        class="mt-2 mr-2"
                        type="button"
                        @click.prevent="selectNewImage"
                    >
                        <i class="bi bi-plus mr-2"></i>
                        {{
                            form.lampiran_aduan.length > 0
                                ? "Tambah Lampiran"
                                : "Muat Naik Lampiran"
                        }}
                    </SecondaryButton>

                    <InputError
                        v-if="
                            form.errors.lampiran_aduan &&
                            form.lampiran_aduan.length < 3
                        "
                        :message="form.errors.lampiran_aduan"
                        class="mt-2"
                    />
                </div>
            </template>

            <template #actions>
                <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                    Berjaya Disimpan.
                </ActionMessage>
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    <span class="flex gap-2">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="currentColor"
                            class="bi bi-fast-forward"
                            viewBox="0 0 16 16"
                        >
                            <path
                                d="M6.804 8 1 4.633v6.734L6.804 8Zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C.713 12.69 0 12.345 0 11.692V4.308c0-.653.713-.998 1.233-.696l6.363 3.692Z"
                            />
                            <path
                                d="M14.804 8 9 4.633v6.734L14.804 8Zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C8.713 12.69 8 12.345 8 11.692V4.308c0-.653.713-.998 1.233-.696l6.363 3.692Z"
                            />
                        </svg>
                        Kemaskini
                    </span>
                </PrimaryButton>
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
