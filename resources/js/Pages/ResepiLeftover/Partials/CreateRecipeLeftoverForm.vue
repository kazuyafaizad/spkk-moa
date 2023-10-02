<script setup>
import { ref } from 'vue';
import { Link, router, useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    resepi: Object,
});

const form = useForm({
    title: "",
    description: "",
    image: null,
});

const verificationLinkSent = ref(null);
const imagePreview = ref(null);
const imageInput = ref(null);

const updateProfileInformation = () => {
    if (imageInput.value) {
        form.image = imageInput.value.files[0];
    }

    form.post(route('resepileftover.admin.store'), {
        errorBag: 'updateProfileInformation',
        preserveScroll: true,
        onSuccess: () => clearImageFileInput(),
    });
};

const sendEmailVerification = () => {
    verificationLinkSent.value = true;
};

const selectNewImage = () => {
    imageInput.value.click();
};

const updateImagePreview = () => {
    const image = imageInput.value.files[0];

    if (! image) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        imagePreview.value = e.target.result;
    };

    reader.readAsDataURL(image);
};

const deleteImage = () => {
    router.delete(route('current-user-image.destroy'), {
        preserveScroll: true,
        onSuccess: () => {
            imagePreview.value = null;
            clearImageFileInput();
        },
    });
};

const clearImageFileInput = () => {
    if (imageInput.value?.value) {
        imageInput.value.value = null;
    }
};
</script>

<template>
    <FormSection @submitted="updateProfileInformation">
        <template #title>

        </template>

        <template #description>
            Tambah resepi leftover beserta dengan imej, tajuk dan keterangan. Gambar hendaklah berukuran 1024px x 1024px.
        </template>

        <template #form>
            <!-- Profile Image -->
            <div class="col-span-12 sm:col-span-6 flex flex-col items-center">
                <!-- Profile Image File Input -->
                <input ref="imageInput" type="file" class="hidden" @change="updateImagePreview">

                <InputLabel for="image" value="Imej" />

                <!-- New Profile Image Preview -->
                <div v-show="imagePreview" class="mt-2">
                    <span class="block  w-72 h-72 bg-cover bg-no-repeat bg-center"
                        :style="'background-image: url(\'' + imagePreview + '\');'" />
                </div>

                <SecondaryButton class="mt-2 mr-2" type="button" @click.prevent="selectNewImage">
                    Pilih imej di Komputer
                </SecondaryButton>

                <SecondaryButton v-if="resepi.image" type="button" class="mt-2" @click.prevent="deleteImage">
                    Remove Image
                </SecondaryButton>

                <InputError :message="form.errors.image" class="mt-2" />
            </div>

            <!-- Name -->
            <div class="col-span-12 sm:col-span-6">
                <InputLabel for="title" value="Tajuk" />
                <TextInput id="title" v-model="form.title" type="text" class="mt-1 block w-full" required
                    autocomplete="title" />
                <InputError :message="form.errors.title" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="col-span-12 sm:col-span-6">
                <InputLabel for="email" value="Keterangan" />
                <textarea id="description" v-model="form.description" type="text" class="mt-1 block w-full h-32" required
                    autocomplete="description" />
                <InputError :message="form.errors.description" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                Berjaya Disimpan.
            </ActionMessage>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Simpan
            </PrimaryButton>
        </template>
    </FormSection>
</template>
