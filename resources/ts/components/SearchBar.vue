<script setup lang="ts">
import { MagnifyingGlass } from "./icons";

const props = defineProps<{ placeholder?: string }>();
const model = defineModel<string>();
</script>

<template>
    <div class="border rounded-full flex items-center">
        <input
            class="h-full w-full px-4 bg-transparent focus:outline-none text-slate-700"
            type="text"
            v-model="model"
            :placeholder="props.placeholder"
        />
        <button
            class="py-2 pr-2 pl-1 grid place-items-center min-w-16 hover:bg-slate-800 bg-slate-950 text-white rounded-r-full"
        >
            <MagnifyingGlass />
        </button>
    </div>
</template>
