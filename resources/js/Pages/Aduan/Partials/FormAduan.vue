<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const storeAduan = ()=>{

}
</script>

<template>
    <div class="md:col-span-1 flex justify-between">
        <!-- <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium text-gray-900">
                Maklumat Asas
            </h3>
        </div> -->

    </div>

      <FormSection @submitted="storeAduan">
            <template #title>
              Maklumat Jadual
            </template>

            <template #description>
                <div class="text-gray-900 font-bold text-xl mb-2">
                    <p class="text-gray-700 text-base">Nama Taman: {{ route().params.taman?.name }}</p>
                    <p class="text-gray-700 text-base">Nama Jalan: {{ route().params.jalan?.name }}</p>
                </div>
            </template>

            <template #form>

                <!-- Name -->
                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="name" value=" Keterangan Aduan" />
                     <textarea
                        class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"
                        id="alamat" rows="3"
                        placeholder="Masukkan keterangan aduan"></textarea>
                    <InputError :message="form.errors.name" class="mt-2" />
                </div>

            </template>

            <template #actions>
                <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                    Saved.
                </ActionMessage>

                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save
                </PrimaryButton>
            </template>
        </FormSection>
</template>
