<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import type { Product } from "../Pages/Home.vue";
import { formatCurrency } from "../utils";
import Button from "./Button.vue";

const props = defineProps<{ product: Product }>();

const addToCartForm = useForm({
    productId: props.product.id,
});

const addToCart = () => {
    addToCartForm.post("/cart/items", {
        onError(error) {
            console.log({ error });
        },
    });
};
</script>

<template>
    <div class="border rounded-md">
        <div class="w-full bg-slate-100 rounded-t-md">
            <img
                class="w-full h-full rounded-t-md"
                :src="props.product.picture"
                :alt="props.product.name"
            />
        </div>
        <div class="px-4 pt-4">
            <p class="text-lg font-semibold">
                {{ props.product.name }}
            </p>
            <p class="text-slate-700">
                {{ formatCurrency(props.product.price, "IDR") }}
            </p>
        </div>
        <div class="flex flex-col gap-y-2 px-4 pb-4 mt-4">
            <Button
                @click="addToCart"
                :loading="addToCartForm.processing"
                variant="secondary"
                >Add to cart</Button
            >
            <Button variant="primary">Buy now</Button>
        </div>
    </div>
</template>
