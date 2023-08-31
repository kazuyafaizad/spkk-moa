<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

const classes = computed(() => {
    return props.active
        ? 'menu single-menu active'
        : 'menu single-menu';
});
</script>

<template>
     <li   :class="classes">
                                <Link :href="href">
                                     <slot />
                                </Link>
                            </li>
</template>


