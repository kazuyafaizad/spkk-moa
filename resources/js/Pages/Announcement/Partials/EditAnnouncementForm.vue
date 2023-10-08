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
    announcement: Object,
});

const form = useForm({
    _method: 'PUT',
    id:props.announcement.id,
    title: props.announcement.title,
    display_at : props.announcement.display_at,
    content: props.announcement.content,
    image: null,
});

const verificationLinkSent = ref(null);
const imagePreview = ref(null);
const imageInput = ref(null);

const updateRecipe = () => {
    if (imageInput.value) {
        form.image = imageInput.value.files[0];
    }

    form.post(route('announcement.update'), {
        errorBag: 'updateRecipeLeftover',
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

const checkURL = (url) =>{
     const urlRegex = /^(https?|ftp):\/\/[^\s/$.?#].[^\s]*$/i;
    return urlRegex.test(url);
}
</script>

<template>
    <FormSection @submitted="updateRecipe">
        <template #title>

        </template>

        <template #description>
            Sunting Pengumuman beserta dengan imej, tajuk dan keterangan. Gambar hendaklah berukuran 1024px x 1024px.
        </template>

        <template #form>
            <!-- Profile Image -->
            <div class="col-span-12 sm:col-span-6 flex flex-col items-center">
                <!-- Profile Image File Input -->
                <input ref="imageInput" type="file" class="hidden" @change="updateImagePreview">

                <InputLabel for="image" value="Imej" />

                <div v-show="!imagePreview" class="mt-2">
                        <img :src="checkURL($page.props.announcement.image) ? $page.props.announcement.image : '/' + $page.props.announcement.image" :alt="announcement.title" class="w-72 h-72 bg-cover bg-no-repeat bg-center">
                    </div>
                <!-- New Profile Image Preview -->
                <div v-show="imagePreview" class="mt-2">
                    <span class="block  w-72 h-72 bg-cover bg-no-repeat bg-center"
                        :style="'background-image: url(\'' + imagePreview + '\');'" />
                </div>

                <SecondaryButton class="mt-2 mr-2" type="button" @click.prevent="selectNewImage">
                    Pilih imej di Komputer
                </SecondaryButton>

                <!-- <SecondaryButton v-if="announcement?.image" type="button" class="mt-2" @click.prevent="deleteImage">
                    Remove Image
                </SecondaryButton> -->

                <InputError :message="form.errors.image" class="mt-2" />
            </div>


            <div class="col-span-12 sm:col-span-6">
                <InputLabel for="title" value="Tajuk" />
                <TextInput id="title" v-model="form.title" type="text" class="mt-1 block w-full" required
                    autocomplete="title" />
                <InputError :message="form.errors.title" class="mt-2" />
            </div>

            <div class="col-span-12 sm:col-span-6">
                        <InputLabel for="display_at" value="Papar Pada" />
                        <input id="display_at" v-model="form.display_at" type="datetime-local" class="mt-1 block w-full" required
                            autocomplete="display_at" />
                        <InputError :message="form.errors.display_at" class="mt-2" />
            </div>

            <div class="col-span-12 sm:col-span-6">
                <InputLabel for="email" value="Keterangan" />
                <textarea id="content" v-model="form.content" type="text" class="mt-1 block w-full h-32" required
                    autocomplete="content" />
                <InputError :message="form.errors.content" class="mt-2" />
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
