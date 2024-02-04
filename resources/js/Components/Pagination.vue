<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({
    links: { type: Array, default: Array },
});
</script>
<template>
    <div v-if="links.length > 3">
        <div class="flex flex-wrap -mb-1">
            <template v-for="(link, key) in links">
                <!-- eslint-disable vue/no-v-html -->
                <div
                    v-if="link.url === null"
                    :key="key"
                    class="mb-1 mr-1 px-4 py-3 text-gray-400 text-sm leading-4 border rounded"
                />
                <Link
                    v-else
                    :key="`link-${key}`"
                    preserve-scroll
                    :data="{ query }"
                    preserve-state
                    class="mb-1 mr-1 px-4 py-3 focus:text-indigo-500 text-sm leading-4 hover:bg-white border focus:border-indigo-500 rounded"
                    :class="{ 'bg-white': link.active }"
                    :href="link.url"
                />
                <!--eslint-enable-->
            </template>
        </div>
    </div>
</template>
