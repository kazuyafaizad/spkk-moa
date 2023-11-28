<script setup>
import { ref,onMounted } from 'vue';
import { Link,useForm } from '@inertiajs/vue3';
import {Multiselect} from 'vue-multiselect';
import axios from 'axios';


defineProps({
    selectedComplaint: Object,
    ppks:Object,
    form:Object
});
</script>

<template>
    <!-- <div>
        <transition leave-active-class="transition ease-in duration-1000" leave-from-class="opacity-100"
            leave-to-class="opacity-0">
            <div v-show="on" class="text-sm text-gray-600">
                <slot />
            </div>
        </transition>
    </div> -->
    <div class="flex flex-col flex-grow p-4">
                            <div class="flex w-full mt-2 space-x-3 max-w-xs">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-300"></div>
                                <div>
                                    <div class="bg-gray-300 p-3 rounded-r-lg rounded-bl-lg">

                                        <p class="text-sm">PBT : {{ selectedComplaint.pbt.name }}</p>
                                        <p class="text-sm">Jalan : {{ selectedComplaint.street.name }}</p>
                                        <p class="text-sm">{{ selectedComplaint.description }}</p>
                                    </div>
                                    <span class="text-xs text-gray-500 leading-none">{{ selectedComplaint.created_at }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex w-full mt-2 space-x-3 max-w-xs ml-auto justify-end">
                            <div>
                                <div class="bg-blue-600 text-white p-3 rounded-l-lg rounded-br-lg">
                                    <p class="text-sm text-white">Kepada</p>
                                     <Multiselect v-model="form.ppk" :options="ppks" placeholder="Sila Pilih" label="name" track-by="name">
                                        </Multiselect>
                                </div>
                                <span class="text-xs text-gray-500 leading-none"></span>
                            </div>
                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-300"></div>
                        </div>
</template>
