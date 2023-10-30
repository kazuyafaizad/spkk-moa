<script setup>
import { ref } from 'vue';
import { useForm,usePage } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
     data: Object,
})


const storeAduan = ()=>{

}

const form = useForm({
    schedule_id : usePage().props.selected.jadual_id,
    park : usePage().props.selected.park_name,
    park_id : usePage().props.selected.park_id,
    street : usePage().props.selected.street_name,
    street_id : usePage().props.selected.street_id,
    activity_code : usePage().props.selected.activity_code,
    time_start : usePage().props.selected.time_start,
    time_end : usePage().props.selected.time_end,
    date : usePage().props.selected.date,
    pbt_id : usePage().props.selected.pbt_id,
    scheme_id : usePage().props.selected.scheme_id,
    description : ""

})

const submit = () => {
    form.post(route('complaint.store'));
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
                <ul class="text-gray-900 font-bold text-xl mb-2">
                    <li class="text-base border-slate-100 text-slate-700 rounded-t-1 group relative flex w-full cursor-pointer items-center border-b border-solid p-4 text-left font-semibold text-dark-500">Nama Taman: {{ form.park }}</li>
                    <li class="text-base border-slate-100 text-slate-700 rounded-t-1 group relative flex w-full cursor-pointer items-center border-b border-solid p-4 text-left font-semibold text-dark-500">Nama Jalan: {{ form.street }}</li>
                    <li class="text-base border-slate-100 text-slate-700 rounded-t-1 group relative flex w-full cursor-pointer items-center border-b border-solid p-4 text-left font-semibold text-dark-500">Kod Aktiviti: {{ form.activity_code }}</li>
                    <li class="text-base border-slate-100 text-slate-700 rounded-t-1 group relative flex w-full cursor-pointer items-center border-b border-solid p-4 text-left font-semibold text-dark-500">Masa: {{ form.time_start+" - "+form.time_end }}</li>
                    <li class="text-base border-slate-100 text-slate-700 rounded-t-1 group relative flex w-full cursor-pointer items-center border-b border-solid p-4 text-left font-semibold text-dark-500">Tarikh: {{ form.date }}</li>

                </ul>
            </template>

            <template #form>
                <!-- Name -->
                <div class="col-span-12 sm:col-span-12">
                    <InputLabel for="aduan" value=" Keterangan Aduan" />
                     <textarea
                        class="block appearance-none w-full py-1 px-2 mb-1 text-base leading-normal bg-white text-gray-800 border border-gray-200 rounded"
                        v-model="form.description"
                        id="aduan" rows="15"
                        placeholder="Masukkan keterangan aduan"></textarea>
                    <InputError :message="form.errors.decription" class="mt-2" />
                </div>

            </template>

            <template #actions>
                <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                    Berjaya Disimpan.
                </ActionMessage>

                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing" @click="submit">
                    <span class="flex gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fast-forward" viewBox="0 0 16 16">
                    <path d="M6.804 8 1 4.633v6.734L6.804 8Zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C.713 12.69 0 12.345 0 11.692V4.308c0-.653.713-.998 1.233-.696l6.363 3.692Z"/>
                    <path d="M14.804 8 9 4.633v6.734L14.804 8Zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C8.713 12.69 8 12.345 8 11.692V4.308c0-.653.713-.998 1.233-.696l6.363 3.692Z"/>
                    </svg> Hantar
                    </span>
                </PrimaryButton>
            </template>
        </FormSection>
</template>
