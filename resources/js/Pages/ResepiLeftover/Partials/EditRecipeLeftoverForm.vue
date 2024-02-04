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
    recipe: Object,
});

const form = useForm({
    _method: "PUT",
    id: props.recipe.id,
    title: props.recipe.title,
    description: props.recipe.description,
    status: props.recipe.status,
    image: null,
});

const imagePreview = ref(null);
const imageInput = ref(null);

const updateRecipe = () => {
    if (imageInput.value) {
        form.image = imageInput.value.files[0];
    }

    form.post(route("admin.recipe.update"), {
        errorBag: "updateRecipeLeftover",
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
        form.delete(route("admin.recipe.destroy", { recipe: props.recipe }), {
            preserveScroll: true,
            // onSuccess: () => {
            //     imagePreview.value = null;
            //     clearImageFileInput();
            // },
            // onFinish:()=>{
            //         alert("Telah Berjaya dipadam")
            //     }
        });
    }
};

const clearImageFileInput = () => {
    if (imageInput.value?.value) {
        imageInput.value.value = null;
    }
};

const checkURL = (url) => {
    const urlRegex = /^(https?|ftp):\/\/[^\s/$.?#].[^\s]*$/i;
    return urlRegex.test(url);
};
const config = ref({ height: "200px" });
</script>

<template>
    <FormSection @submitted="updateRecipe">
        <template #title> </template>

        <template #description>
            Tambah Discover More beserta dengan imej, tajuk dan keterangan.
            Gambar hendaklah berukuran 1024px x 1024px.
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

                <div v-show="!imagePreview" class="mt-2">
                    <img
                        :src="
                            checkURL($page.props.recipe.image)
                                ? $page.props.recipe.image
                                : '/' + $page.props.recipe.image
                        "
                        :alt="recipe.title"
                        class="w-72 h-72 bg-cover bg-no-repeat bg-center"
                    />
                </div>
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

                <!-- <SecondaryButton v-if="recipe?.image" type="button" class="mt-2" @click.prevent="deleteImage">
                    Remove Image
                </SecondaryButton> -->

                <InputError :message="form.errors.image" class="mt-2" />
            </div>

            <div class="col-span-12 sm:col-span-6">
                <InputLabel for="title" value="Tajuk" class="required" />
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
                <InputLabel for="email" value="Keterangan" />
                <ckeditor
                    v-model="form.description"
                    :editor="editor"
                    :config="config"
                    class="mt-1 block w-full h-32"
                >
                </ckeditor>
                <!-- <textarea id="description" v-model="form.description" type="text" class="mt-1 block w-full h-32" required
                    autocomplete="description" /> -->
                <InputError :message="form.errors.description" class="mt-2" />
            </div>

            <div class="col-span-12 sm:col-span-6">
                <InputLabel for="display_at" value="Status" />
                <label
                    class="relative flex justify-between items-center group p-2 text-xl"
                >
                    {{ form.status ? "Aktif" : "Tidak Aktif" }}
                    <input
                        v-model="form.status"
                        type="checkbox"
                        class="absolute left-1/2 -translate-x-1/2 w-full h-full peer appearance-none rounded-md"
                    />
                    <span
                        class="w-16 h-10 flex items-center flex-shrink-0 ml-4 p-1 bg-gray-300 rounded-full duration-300 ease-in-out peer-checked:bg-green-400 after:w-8 after:h-8 after:bg-white after:rounded-full after:shadow-md after:duration-300 peer-checked:after:translate-x-6 group-hover:after:translate-x-1"
                    ></span>
                </label>
                <InputError :message="form.errors.display_at" class="mt-2" />
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
                Kemaskini
            </PrimaryButton>
        </template>
    </FormSection>
</template>
