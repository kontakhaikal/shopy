<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import { Ref, computed, ref } from "vue";
import Button from "../components/Button.vue";
import { formatCurrency } from "../utils";
import { Product } from "./Home.vue";

interface Cart {
    id: string;
    items: CartItem[];
}

interface CartItem {
    product: Product;
    quantity: number;
    selected: boolean;
}

const props = defineProps<{ cart: Cart }>();

const items: Ref<CartItem[]> = ref(props.cart.items);

const totalPrice = computed(() =>
    items.value.reduce(
        (total, item) =>
            item.selected ? total + item.product.price * item.quantity : total,
        0
    )
);

const checkOutForm = useForm<{
    items: { productId: string; quantity: number }[];
}>({
    items: [],
});

const checkOut = () => {
    checkOutForm.items = items.value
        .filter((item) => item.selected)
        .map((item) => ({
            productId: item.product.id,
            quantity: item.quantity,
        }));

    checkOutForm.post("/checkout");
};
</script>

<template>
    <main>
        <section class="px-6 py-4 rounded-md">
            <div class="sticky top-0 w-full bg-white py-4 z-50">
                <h1 class="text-2xl font-semibold">Cart</h1>
            </div>
            <div class="flex gap-x-4">
                <ul class="flex flex-col gap-y-2 mt-4 w-full max-w-[42rem]">
                    <li
                        class="flex border rounded-md items-center gap-x-2 justify-between p-4"
                        v-for="item in items"
                    >
                        <div class="flex gap-x-6">
                            <div>
                                <input
                                    class="accent-slate-950"
                                    v-model="item.selected"
                                    type="checkbox"
                                />
                            </div>

                            <div class="w-28 rounded-md bg-slate-100">
                                <img
                                    class="w-full h-full"
                                    :src="item.product.picture"
                                    :alt="item.product.name"
                                />
                            </div>
                            <div class="flex flex-col justify-between">
                                <div class="flex flex-col gap-y-1">
                                    <p class="font-semibold">
                                        {{ item.product.name }}
                                    </p>
                                    <p class="text-slate-700">
                                        {{
                                            formatCurrency(
                                                item.product.price,
                                                "IDR"
                                            )
                                        }}
                                    </p>
                                </div>
                                <div class="flex gap-x-2 items-center">
                                    <div class="border rounded-md">
                                        <button
                                            :disabled="item.quantity <= 1"
                                            @click="item.quantity--"
                                            class="py-1 px-4 bg-slate-50 rounded-l-md border-r"
                                            p-y-4
                                        >
                                            -
                                        </button>
                                        <input
                                            readonly
                                            class="text-center w-12 focus:outline-none text-sm"
                                            type="text"
                                            v-model="item.quantity"
                                        />
                                        <button
                                            :disabled="
                                                item.quantity >=
                                                item.product.stock
                                            "
                                            @click="item.quantity++"
                                            class="py-1 px-4 bg-slate-50 rounded-r-md border-l"
                                        >
                                            +
                                        </button>
                                    </div>
                                    <p class="text-sm text-slate-700">
                                        of {{ item.product.stock }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="px-4 flex gap-x-6">
                            <p class="text-slate-700">Sub Total:</p>
                            <p class="font-semibold text-lg">
                                {{
                                    formatCurrency(
                                        item.quantity * item.product.price,
                                        "IDR"
                                    )
                                }}
                            </p>
                        </div>
                    </li>
                </ul>

                <div class="mt-4 w-full max-w-[24rem]">
                    <div class="border rounded-md p-4 sticky top-16">
                        <p class="font-semibold text-lg">Cart Summary</p>
                        <div class="flex mt-4 gap-x-6">
                            <p class="text-slate-700">Total Price:</p>
                            <p class="font-semibold">
                                {{ formatCurrency(totalPrice, "IDR") }}
                            </p>
                        </div>
                        <div class="mt-6 flex flex-col gap-y-2">
                            <Button variant="secondary">Save Changes</Button>
                            <Button
                                @click="checkOut"
                                :loading="checkOutForm.processing"
                                variant="primary"
                            >
                                Checkout</Button
                            >
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>
