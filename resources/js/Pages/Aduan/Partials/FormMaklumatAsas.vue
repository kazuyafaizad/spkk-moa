<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('user-password.update'), {
        errorBag: 'updatePassword',
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }

            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <div class="md:col-span-1 flex justify-between">
        <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium text-gray-900">
                Maklumat Asas
            </h3>
        </div>

    </div>
    <form>
        <div class="flex flex-wrap   mb-4">
            <label for="colFormLabelSm"
                class="sm:w-1/5 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal pt-1 pb-1 mb-0 leading-normal">Nama
                Penuh</label>
            <div class="sm:w-4/5 pr-4 pl-4">
                <input type="text"
                    class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded py-1 px-2 text-sm leading-normal rounded"
                    id="nama" placeholder="Mohd Hanif bin Mohd Salleh">
                <!-- <input type="email" class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded py-1 px-2 text-sm leading-normal rounded" id="colFormLabelSm" placeholder="col-form-label-sm"> -->
            </div>
        </div>
        <div class="flex flex-wrap   mb-4">
            <label for="colFormLabelSm"
                class="sm:w-1/5 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal pt-1 pb-1 mb-0 leading-normal">No.
                Pengenalan</label>
            <div class="sm:w-4/5 pr-4 pl-4">
                <input type="text"
                    class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded py-1 px-2 text-sm leading-normal rounded"
                    id="ic" placeholder="888888888888">
            </div>
        </div>
        <div class="flex flex-wrap   mb-4">
            <label for="colFormLabelSm"
                class="sm:w-1/5 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal pt-1 pb-1 mb-0 leading-normal">Alamat</label>
            <div class="sm:w-4/5 pr-4 pl-4">
                <textarea
                    class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"
                    id="alamat" rows="3"
                    placeholder="No. C-03-05, ITech Tower Jalan Impact, Cyber 6, 63000 Cyberjaya Selangor"></textarea>
            </div>
        </div>
        <div class="flex flex-wrap  mb-4">
            <label for="colFormLabelSm"
                class="sm:w-1/5 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal pt-1 pb-1 mb-0 leading-normal">No.
                Telefon</label>
            <div class="sm:w-4/5 pr-4 pl-4">
                <input type="text"
                    class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded py-1 px-2 text-sm leading-normal rounded"
                    id="telefon" placeholder="0172266522">
            </div>
        </div>
        <div class="flex flex-wrap  mb-4">
            <label for="colFormLabelSm"
                class="sm:w-1/5 pr-4 pl-4 pt-2 pb-2 mb-0 leading-normal pt-1 pb-1 mb-0 leading-normal">Email</label>
            <div class="sm:w-4/5 pr-4 pl-4">
                <input type="email"
                    class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded py-1 px-2 text-sm leading-normal rounded"
                    id="email" placeholder="hanif@2bytes.com.my">
            </div>
        </div>
    </form>
</template>
