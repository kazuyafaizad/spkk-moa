<script setup>
import { onMounted, ref } from "vue";

defineProps({
    modelValue: String,
    typeValue: { type: String, default: "text" },
});

defineEmits(["update:modelValue"]);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <div class="flex items-center border-b border-black py-2">
        <input
            ref="input"
            class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none"
            :value="modelValue"
            :type="typeValue"
            @input="$emit('update:modelValue', $event.target.value)"
        />
    </div>
</template>
