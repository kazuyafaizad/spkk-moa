<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="btn btn-primary rounded-md font-semibold text-xs  uppercase tracking-widest shadow-sm">
        <slot />
    </button>
</template>
