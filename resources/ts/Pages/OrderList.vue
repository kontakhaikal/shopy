<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import PackOrder from "../components/PackOrder.vue";
import PendingOrder from "../components/PendingOrder.vue";
import { ShippingMethod } from "./Checkout.vue";
import type { Product } from "./Home.vue";

const orderStatus = {
    Pending: "pending",
    Pack: "pack",
    Delivered: "delivered",
    Completed: "completed",
    Cancelled: "cancelled",
} as const;

export type OrderStatus = (typeof orderStatus)[keyof typeof orderStatus];

export interface Order {
    id: string;
    items: OrderItem[];
    shipping: {
        method: ShippingMethod;
    };
    status: OrderStatus;
}

export interface OrderItem {
    id: string;
    product: Product;
    price: number;
    quantity: number;
}

const props = defineProps<{ orders: Order[]; status: OrderStatus }>();
</script>

<template>
    <main class="container mt-4">
        <ul class="flex border rounded-md w-fit p-2 gap-x-8">
            <li v-for="(value, key) of orderStatus">
                <Link
                    :href="`/orders?status=${value}`"
                    class="py-1 px-3 rounded-md font-semibold"
                    :class="{
                        'bg-slate-950 text-white pointer-events-none':
                            value === props.status,
                    }"
                >
                    {{ key }}
                </Link>
            </li>
        </ul>
        <ul class="flex gap-4 mt-4 flex-wrap">
            <PendingOrder
                v-if="props.status === orderStatus.Pending"
                v-for="order in props.orders"
                :order="order"
            />
            <PackOrder
                v-if="props.status === orderStatus.Pack"
                v-for="order in props.orders"
                :order="order"
            />
        </ul>
    </main>
</template>
