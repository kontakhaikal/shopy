<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import { Ref, computed, ref } from "vue";
import Button from "../components/Button.vue";
import Input from "../components/Input.vue";
import PaymentMethod from "../components/PaymentMethod.vue";
import type { Product } from "./Home.vue";

interface OrderItem {
    product: Product;
    quantity: number;
}

const props = defineProps<{ items: OrderItem[] }>();

const items: Ref<OrderItem[]> = ref(props.items);

const totalPrice = computed(() => {
    return items.value.reduce(
        (total, item) => total + item.product.price * item.quantity,
        0
    );
});

const orderForm = useForm({
    items: [],
    address: "",
});
</script>

<template>
    <main>
        <section class="px-6 py-4 rounded-md">
            <div class="sticky top-0 w-full bg-white py-4 z-50">
                <h1 class="text-2xl font-semibold">Order</h1>
            </div>
            <div class="flex gap-x-4">
                <ul class="flex flex-col gap-y-2 mt-4 w-full max-w-[42rem]">
                    <li
                        class="flex border rounded-md items-center gap-x-2 justify-between p-4"
                        v-for="item in items"
                    >
                        <div class="flex gap-x-6">
                            <div class="w-28 rounded-md bg-slate-100">
                                <img
                                    class="w-full h-full"
                                    :src="item.product.picture"
                                    :alt="item.product.name"
                                />
                            </div>
                            <div class="flex flex-col justify-between">
                                <div class="flex flex-col gap-y-1">
                                    <p class="font-semibold text-xl">
                                        {{ item.product.name }}
                                    </p>
                                    <p class="text-slate-700">
                                        ${{ item.product.price }} x
                                        {{ item.quantity }}
                                    </p>
                                </div>
                                <div class="flex gap-x-6">
                                    <p class="text-slate-700">Sub Total:</p>
                                    <p class="font-semibold text-lg">
                                        ${{
                                            item.quantity * item.product.price
                                        }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>

                <div class="mt-4 w-full max-w-[24rem] px-4">
                    <div class="border rounded-md p-4 sticky top-16">
                        <p class="font-semibold text-lg">Order Summary</p>

                        <div class="mt-6 flex flex-col gap-y-1">
                            <label for="">Address</label>
                            <input class="border rounded-md p-2" />
                        </div>

                        <div class="mt-6">
                            <PaymentMethod />
                        </div>

                        <div class="flex mt-4 gap-x-6">
                            <p class="text-slate-700">Total Price:</p>
                            <p class="font-semibold">${{ totalPrice }}</p>
                        </div>
                        <div class="mt-6 flex flex-col gap-y-2">
                            <Button variant="primary"> Checkout</Button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>
