<script setup lang="ts">
import { Loader } from "./icons";

type ValueOf<T> = T[keyof T];

const variant = {
    primary: "primary",
    secondary: "secondary",
} as const;

const props = defineProps<{
    variant: ValueOf<typeof variant>;
    loading?: boolean;
}>();
</script>

<template>
    <button
        :disabled="props.loading"
        class="rounded-md w-full py-1.5 px-2 font-semibold grid place-items-center"
        type="submit"
        :class="{
            'bg-slate-950 disabled:bg-slate-700 text-white hover:bg-slate-800':
                props.variant === variant.primary,
            'bg-slate-50 disabled:bg-slate-200 text-slate-950 border hover:bg-slate-100':
                props.variant === variant.secondary,
        }"
    >
        <Loader v-if="props.loading" class="animate-spin" />
        <slot v-else></slot>
    </button>
</template>
