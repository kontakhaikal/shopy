<script setup lang="ts">
import { ExclamationMark } from "./icons";

const props = defineProps<{ message: string }>();
</script>

<template>
    <div class="flex gap-x-2 items-center">
        <ExclamationMark class="w-4 h-4 block text-red-500" />
        <p class="text-red-500 text-sm">{{ props.message }}</p>
    </div>
</template>
