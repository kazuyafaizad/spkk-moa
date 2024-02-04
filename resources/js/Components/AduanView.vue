<script setup>
import { Multiselect } from "vue-multiselect";

defineProps({
    selectedComplaint: { type: Object, default: Object },
    ppks: { type: Object, default: Object },
    form: { type: Object, default: Object },
});
</script>

<template>
    <div class="flex flex-col flex-grow p-4">
        <div class="flex w-full mt-2 space-x-3 max-w-xs">
            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-300">
                <i
                    class="bi bi-megaphone h-full flex items-center justify-center"
                ></i>
            </div>
            <div class="flex gap-2 flex-col">
                <div class="bg-gray-300 p-3 rounded-r-lg rounded-bl-lg">
                    <p class="text-sm">
                        PBT : {{ selectedComplaint.pbt?.name }}
                    </p>
                    <p class="text-sm">
                        Jalan : {{ selectedComplaint.street?.name }}
                    </p>
                </div>
                <div class="bg-gray-300 p-3 rounded-r-lg rounded-bl-lg">
                    <p class="text-sm">{{ selectedComplaint.description }}</p>
                </div>
                <div class="bg-gray-300 p-3 rounded-r-lg rounded-bl-lg">
                    <div class="grid grid-cols-3 overflow-auto">
                        <template
                            v-for="(img, i) in selectedComplaint.lampiran"
                            :key="i"
                        >
                            <a :href="img.url" target="_blank"
                                ><img :src="img.url"
                            /></a>
                        </template>
                    </div>
                </div>

                <span class="text-xs text-gray-500 leading-none">{{
                    selectedComplaint.created_at
                }}</span>
            </div>
        </div>
    </div>
    <div class="flex w-full mt-2 space-x-3 max-w-xs ml-auto justify-end">
        <div>
            <div class="bg-blue-600 text-white p-3 rounded-l-lg rounded-br-lg">
                <p class="text-sm text-white">Kepada</p>
                <Multiselect
                    v-model="form.ppk"
                    :options="ppks"
                    placeholder="Sila Pilih"
                    label="name"
                    track-by="name"
                >
                </Multiselect>
            </div>
            <span class="text-xs text-gray-500 leading-none"></span>
        </div>
        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-300">
            <i
                class="bi bi-person-fill-exclamation h-full flex items-center justify-center"
            ></i>
        </div>
    </div>
</template>
