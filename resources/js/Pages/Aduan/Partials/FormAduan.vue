<script setup>
import { ref } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";
import ActionMessage from "@/Components/ActionMessage.vue";
import FormSection from "@/Components/FormSection.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";

defineProps({
    data: Object,
});

const imagePreviews = ref(null);
const imageInput = ref(null);
const storeAduan = () => {};

const form = useForm({
    schedule_id: usePage().props.selected.jadual_id,
    park: usePage().props.selected.park_name,
    park_id: usePage().props.selected.park_id,
    street: usePage().props.selected.street_name,
    street_id: usePage().props.selected.street_id,
    activity_code: usePage().props.selected.activity_code,
    time_start: usePage().props.selected.time_start,
    time_end: usePage().props.selected.time_end,
    date: usePage().props.selected.date,
    pbt_id: usePage().props.selected.pbt_id,
    scheme_id: usePage().props.selected.scheme_id,
    description: "",
    lampiran_aduan: [],
});

const submitForm = () => {
    form.clearErrors();
    form.processing = true;

    if (form.description === "") {
        form.setError("description", "Sila masukkan keterangan aduan");
    }

    if (form.lampiran_aduan.length < 3) {
        form.setError("lampiran_aduan", "Sila masukkan Lampiran (Min. 3)");
    }

    if (!form.hasErrors) {
        form.post(route("complaint.store"), {
            preserveScroll: true,
            forceFormData: true,
            multiple: true,
            onSuccess: () => clearImageFileInput(),
        });
    } else {
        form.processing = false;
    }
};

const selectNewImage = () => {
    imageInput.value.click();
};

const updateImagePreviews = () => {
    const currentImages = form.lampiran_aduan || [];
    const newImages = imageInput.value.files;

    const allImages = [...currentImages, ...Array.from(newImages)];

    const newPreviews = allImages.map((image) => {
        const reader = new FileReader();

        return new Promise((resolve) => {
            reader.onload = (e) => {
                resolve(e.target.result);
            };
            reader.readAsDataURL(image);
        });
    });

    Promise.all(newPreviews).then((previews) => {
        form.lampiran_aduan = allImages;
        imagePreviews.value = previews;
    });
};

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
    <div class="md:col-span-1 flex justify-between"></div>

    <FormSection @submitted="storeAduan">
        <template #title>
            <h2 class="font-semibold text-2xl text-[#3b3f5c]">Aduan Baru</h2>
        </template>

        <template #description>
            Pengadu dinasihatkan membuat keterangan yang terperinci supaya
            tindakan lebih mudah dilaksanakan. Pengadu juga hendaklah sediakan
            tiga(3) gambar sebagai lampiran untuk dimuat naik
        </template>

        <template #form>
            <div class="col-span-12 sm:col-span-12">
                <InputLabel for="park" class="font-bold">Nama Taman</InputLabel>
                <p>{{ form.park }}</p>
            </div>
            <div class="col-span-12 sm:col-span-12">
                <InputLabel for="street" class="font-bold"
                    >Nama Jalan</InputLabel
                >
                <p>{{ form.street }}</p>
            </div>
            <div class="col-span-12 sm:col-span-12">
                <InputLabel for="activity_code" class="font-bold"
                    >Kod Aktiviti</InputLabel
                >
                <p>{{ form.activity_code }}</p>
            </div>
            <div class="col-span-12 sm:col-span-12">
                <InputLabel for="time_range" class="font-bold">Masa</InputLabel>
                <p>{{ form.time_start }} - {{ form.time_end }}</p>
            </div>
            <div class="col-span-12 sm:col-span-12">
                <InputLabel for="date" class="font-bold">Tarikh</InputLabel>
                <p>{{ form.date }}</p>
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
                                'background-image: url(\'' + preview + '\');'
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
                @click="submitForm"
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
                    Hantar
                </span>
            </PrimaryButton>
        </template>
    </FormSection>
</template>
