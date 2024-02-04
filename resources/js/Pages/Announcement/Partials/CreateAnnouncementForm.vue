<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import ActionMessage from "@/Components/ActionMessage.vue";
import FormSection from "@/Components/FormSection.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import CKEditor from "@ckeditor/ckeditor5-vue";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

const editor = ClassicEditor;
const ckeditor = CKEditor.component;

const props = defineProps({
    announcement: Object,
});

const form = useForm({
    title: "",
    content: "",
    display_at: new Date(),
    image: null,
});

const imagePreview = ref(null);
const imageInput = ref(null);

const storeAnnouncement = () => {
    if (imageInput.value) {
        form.image = imageInput.value.files[0];
    }

    form.post(route("admin.announcement.store"), {
        errorBag: "storeAnnouncement",
        preserveScroll: true,
        onSuccess: () => clearImageFileInput(),
    });
};

const selectNewImage = () => {
    imageInput.value.click();
};

const updateImagePreview = () => {
    const image = imageInput.value.files[0];

    if (!image) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        imagePreview.value = e.target.result;
    };

    reader.readAsDataURL(image);
};

const deletePost = () => {
    if (confirm("Anda Pasti untuk memadam?")) {
        form.delete(
            route("admin.announcement.destroy", {
                announcement: props.announcement,
            }),
            {
                preserveScroll: true,
                onSuccess: () => {
                    imagePreview.value = null;
                    clearImageFileInput();
                },
                onFinish: () => {
                    alert("Telah Berjaya dipadam");
                },
            },
        );
    }
};

const clearImageFileInput = () => {
    if (imageInput.value?.value) {
        imageInput.value.value = null;
    }
};
</script>

<template>
    <FormSection @submitted="storeAnnouncement">
        <template #title> </template>

        <template #description>
            Pengumuman Awam. Gambar hendaklah berukuran 1024px x 1024px.
        </template>

        <template #form>
            <!-- Profile Image -->
            <div class="col-span-12 sm:col-span-6 flex flex-col items-center">
                <!-- Profile Image File Input -->
                <input
                    ref="imageInput"
                    type="file"
                    accept="image/*"
                    class="hidden"
                    @change="updateImagePreview"
                />

                <InputLabel for="image" value="Imej" />

                <!-- New Profile Image Preview -->
                <div v-show="imagePreview" class="mt-2">
                    <span
                        class="block w-72 h-72 bg-cover bg-no-repeat bg-center"
                        :style="
                            'background-image: url(\'' + imagePreview + '\');'
                        "
                    />
                </div>

                <SecondaryButton
                    class="mt-2 mr-2"
                    type="button"
                    @click.prevent="selectNewImage"
                >
                    Pilih Imej
                </SecondaryButton>

                <SecondaryButton
                    v-if="recipe?.image"
                    type="button"
                    class="mt-2"
                    @click.prevent="deleteImage"
                >
                    Remove Image
                </SecondaryButton>

                <InputError :message="form.errors.image" class="mt-2" />
            </div>

            <!-- Name -->
            <div class="col-span-12 sm:col-span-6">
                <InputLabel for="title" value="Tajuk" />
                <TextInput
                    id="title"
                    v-model="form.title"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="title"
                />
                <InputError :message="form.errors.title" class="mt-2" />
            </div>

            <div class="col-span-12 sm:col-span-6">
                <InputLabel for="display_at" value="Papar Pada" />
                <input
                    id="display_at"
                    v-model="form.display_at"
                    type="datetime-local"
                    class="mt-1 block w-full"
                    required
                    autocomplete="display_at"
                />
                <InputError :message="form.errors.display_at" class="mt-2" />
            </div>

            <div class="col-span-12 sm:col-span-6">
                <InputLabel for="email" value="Kandungan" />
                <ckeditor
                    v-model="form.content"
                    :editor="editor"
                    :config="config"
                ></ckeditor>
                <InputError :message="form.errors.content" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                Berjaya Disimpan.
            </ActionMessage>
            <div class="hover:cursor-pointer" @click="deletePost">
                <i class="bi bi-trash text-2xl mr-5"></i>
            </div>
            <PrimaryButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                <i class="bi bi-floppy"></i>
                Simpan
            </PrimaryButton>
        </template>
    </FormSection>
</template>
