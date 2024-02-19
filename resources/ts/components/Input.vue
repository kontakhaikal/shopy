<script setup lang="ts">
import { computed, ref } from "vue";

const props = defineProps<{
    alwaysActive?: boolean;
    id: string;
    label: string;
}>();

const model = defineModel<string>();

const focus = ref(false);

const active = computed(
    () => props.alwaysActive || focus.value || model.value !== ""
);
</script>

<template>
    <div class="relative">
        <label
            class="absolute left-2 pointer-events-none text-slate-700 bg-white px-1 transition-all"
            :for="props.id"
            :class="{ '-top-3 text-sm': active, 'top-[20%]': !active }"
            >{{ props.label }}</label
        >
        <input
            @focus="focus = true"
            @blur="focus = false"
            v-model="model"
            :id="props.id"
            class="border rounded-md px-3 py-2 w-full"
            type="text"
        />
    </div>
</template>
