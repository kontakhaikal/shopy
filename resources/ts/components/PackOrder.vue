<script setup lang="ts">
import { computed, ref } from "vue";
import type { Order } from "../Pages/OrderList.vue";
import { formatCurrency } from "../utils";

const props = defineProps<{ order: Order }>();

const shippingCost = ref(props.order.shipping.method.cost);

const itemPrice = computed(() =>
    props.order.items.reduce(
        (total, item) => item.price * item.quantity + total,
        0
    )
);

const totalPrice = computed(() => itemPrice.value + shippingCost.value);
</script>

<template>
    <div class="border rounded-md p-4 flex gap-x-4">
        <ul class="flex flex-col gap-2">
            <li
                class="border rounded-md flex"
                v-for="item in props.order.items"
            >
                <div class="max-w-[8rem] self-center bg-slate-100">
                    <img
                        class="w-full object-cover h-full"
                        :src="item.product.picture"
                        alt=""
                    />
                </div>
                <div class="py-2 pl-2 pr-12 flex flex-col justify-between">
                    <div>
                        <p class="font-semibold text-lg">
                            {{ item.product.name }}
                        </p>
                        <p class="flex gap-x-1">
                            <span>{{ formatCurrency(item.price, "IDR") }}</span>
                            <span>x</span>
                            <span>{{ item.quantity }}</span>
                        </p>
                    </div>
                    <p class="flex gap-x-2">
                        <span class="text-slate-700">Sub Total:</span>
                        <span class="font-semibold">{{
                            formatCurrency(item.price * item.quantity, "IDR")
                        }}</span>
                    </p>
                </div>
            </li>
        </ul>
        <div class="rounded-md border p-4 flex flex-col gap-y-2">
            <p class="flex justify-between gap-x-4">
                <span class="text-slate-700">Item Price:</span>
                <span class="font-semibold">{{
                    formatCurrency(itemPrice, "IDR")
                }}</span>
            </p>
            <p class="flex justify-between gap-x-4">
                <span class="text-slate-700">Shipping Cost:</span>
                <span class="font-semibold">{{
                    formatCurrency(shippingCost, "IDR")
                }}</span>
            </p>

            <p class="flex justify-between gap-x-4">
                <span class="text-slate-700">Total Price:</span>
                <span class="font-semibold">{{
                    formatCurrency(totalPrice, "IDR")
                }}</span>
            </p>
        </div>
    </div>
</template>
