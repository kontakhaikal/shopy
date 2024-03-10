<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import { Ref, computed, ref } from "vue";
import Button from "../components/Button.vue";
import Input from "../components/Input.vue";
import PaymentMethod from "../components/PaymentMethod.vue";
import ShippingOptions from "../components/ShippingOptions.vue";
import { formatCurrency } from "../utils";
import type { Product } from "./Home.vue";
import type { Wallet } from "./Wallet.vue";

interface OrderItem {
    product: Product;
    quantity: number;
}

export interface ShippingMethod {
    id: string;
    name: string;
    cost: number;
}

export interface ShippingOption {
    id: string;
    name: string;
    methods: ShippingMethod[];
}

const props = defineProps<{
    items: OrderItem[];
    wallet: Wallet;
    shippingOptions: ShippingOption[];
}>();

const items: Ref<OrderItem[]> = ref(props.items);

const totalProductPrice = computed(() => {
    return items.value.reduce(
        (total, item) => total + item.product.price * item.quantity,
        0
    );
});

const selectedShippingOptionId = ref(undefined);

const orderForm = useForm({
    items: items.value.map((item) => ({
        productId: item.product.id,
        quantity: item.quantity,
    })),
    shippingMethodId: undefined,
    paymentMethod: "wallet",
});

const createOrder = () => {
    orderForm.post("/orders", {
        onError(error) {
            console.log({ error });
        },
    });
};

const shippingCost = computed(() => {
    if (orderForm.shippingMethodId && selectedShippingOptionId.value) {
        return (
            props.shippingOptions
                .find((o) => o.id === selectedShippingOptionId.value)
                ?.methods.find((m) => m.id === orderForm.shippingMethodId)
                ?.cost ?? 0
        );
    }
    return 0;
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
                                        {{
                                            formatCurrency(
                                                item.product.price,
                                                "IDR"
                                            )
                                        }}
                                        x
                                        {{ item.quantity }}
                                    </p>
                                </div>
                                <div class="flex gap-x-6">
                                    <p class="text-slate-700">Sub Total:</p>
                                    <p class="font-semibold text-lg">
                                        {{
                                            formatCurrency(
                                                item.quantity *
                                                    item.product.price,
                                                "IDR"
                                            )
                                        }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>

                <div class="mt-4 w-full max-w-[28rem] px-4">
                    <div class="border rounded-md p-6 sticky top-16">
                        <p class="font-semibold text-lg">Order Summary</p>

                        <div class="mt-6 flex flex-col gap-y-1">
                            <label for="">Address</label>
                            <input class="border rounded-md p-2" />
                        </div>

                        <ShippingOptions
                            class="mt-4"
                            :shippingOptions="props.shippingOptions"
                            v-model:selectedShippingOption="
                                selectedShippingOptionId
                            "
                            v-model:selectedShippingMethod="
                                orderForm.shippingMethodId
                            "
                        />

                        <PaymentMethod class="mt-6" :wallet="props.wallet" />

                        <div class="flex flex-col mt-6 gap-y-2">
                            <div class="flex justify-between">
                                <p class="text-slate-700">Total Price:</p>
                                <p class="font-semibold">
                                    {{
                                        formatCurrency(totalProductPrice, "IDR")
                                    }}
                                </p>
                            </div>
                            <div class="flex justify-between">
                                <p class="text-slate-700">Shipping Cost:</p>
                                <p class="font-semibold">
                                    {{ formatCurrency(shippingCost, "IDR") }}
                                </p>
                            </div>
                            <div class="flex justify-between">
                                <p class="text-slate-700">Total Payment:</p>
                                <p class="font-semibold">
                                    {{
                                        formatCurrency(
                                            totalProductPrice + shippingCost,
                                            "IDR"
                                        )
                                    }}
                                </p>
                            </div>
                        </div>
                        <div class="mt-6 flex flex-col gap-y-2">
                            <Button
                                @click="createOrder"
                                variant="primary"
                                :loading="orderForm.processing"
                                >Proccess</Button
                            >
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>
