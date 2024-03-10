<script setup lang="ts">
import { ref } from "vue";
import type { Wallet } from "../Pages/Wallet.vue";
import { formatCurrency } from "../utils";
import Button from "./Button.vue";

const props = defineProps<{ wallet: Wallet }>();

const method = {
    WALLET: "wallet",
} as const;

type ValueOf<T> = T[keyof T];

const selectedPayment = ref<ValueOf<typeof method> | null>(null);
</script>

<template>
    <div>
        <p>Payment Method</p>
        <div class="mt-2">
            <div class="pl-2">
                <div class="flex items-center gap-x-3">
                    <button
                        @click="selectedPayment = method.WALLET"
                        class="w-4 h-4 rounded-sm"
                        :class="{
                            'border border-slate-500':
                                selectedPayment !== method.WALLET,
                            'bg-slate-700': selectedPayment === method.WALLET,
                        }"
                    ></button>
                    <div>Wallet</div>
                </div>
                <div
                    class="flex justify-between border p-2 rounded-md mt-2 items-center"
                    v-if="selectedPayment === method.WALLET"
                >
                    <div class="flex gap-x-4">
                        <p class="text-slate-700">Balance:</p>
                        <p class="">
                            {{ formatCurrency(props.wallet.balance, "IDR") }}
                        </p>
                    </div>
                    <a href="/wallet">
                        <Button variant="secondary">Open</Button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>
