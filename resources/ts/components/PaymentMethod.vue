<script setup lang="ts">
import { ref } from "vue";

const method = {
    WALLET: "wallet",
} as const;

const selectedPayment = ref(method.WALLET);
</script>

<template>
    <div>
        <p>Payment Method</p>
        <div class="mt-2">
            <div class="pl-2">
                <div class="flex items-center gap-x-2">
                    <button
                        class="w-3 h-3 rounded-sm"
                        :class="{
                            border: selectedPayment !== method.WALLET,
                            'bg-slate-700': selectedPayment === method.WALLET,
                        }"
                    ></button>
                    <div>Wallet</div>
                </div>
                <div v-if="selectedPayment === method.WALLET">bg</div>
            </div>
        </div>
    </div>
</template>
