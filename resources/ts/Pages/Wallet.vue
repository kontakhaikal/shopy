<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import { computed, ref } from "vue";
import Button from "../components/Button.vue";
import { formatCurrency } from "../utils";

export interface Wallet {
    id: string;
    balance: number;
}

const props = defineProps<{ wallet: Wallet }>();

const active = ref(false);

const ammounts = {
    50_000: 50_000,
    100_000: 100_000,
    150_000: 150_000,
    200_000: 200_000,
    300_000: 300_000,
    400_000: 400_000,
    500_000: 500_000,
} as const;

const topUpForm = useForm<{ amount: number | undefined }>({
    amount: undefined,
});

const handleTopClick = () => {
    if (!active.value) {
        active.value = true;
        return;
    }

    topUpForm.post("/wallet/top-up", {
        onError(error) {
            console.log({ error });
        },
        onFinish() {
            active.value = false;
            topUpForm.reset();
        },
    });
};

const disableTopUpButton = computed(() => {
    if (active.value === false) {
        return false;
    }

    if (active.value === true && topUpForm.amount !== undefined) {
        return false;
    }

    return true;
});
</script>

<template>
    <main class="container">
        <div class="border rounded-md max-w-[24rem] py-4 px-6 mt-12">
            <p class="font-semibold text-2xl">Wallet</p>
            <div class="mt-4">
                <p class="text-slate-700">Balance:</p>
                <p class="font-semibold text-4xl">
                    {{ formatCurrency(props.wallet.balance, "IDR") }}
                </p>
            </div>

            <div v-if="active" class="mt-4">
                <p class="text-slate-700">Select amount:</p>
                <ul class="flex flex-wrap gap-2 justify-between mt-2">
                    <button
                        @click="topUpForm.amount = amount as number"
                        v-for="amount in ammounts"
                        class="border w-[6.5rem] text-center py-2 rounded-md px-6"
                        :class="{
                            'border-slate-950 border-2':
                                topUpForm.amount === amount,
                        }"
                    >
                        {{ amount }}
                    </button>
                </ul>
            </div>

            <div class="mt-4">
                <Button
                    variant="primary"
                    :disabled="disableTopUpButton"
                    :loading="topUpForm.processing"
                    @click="handleTopClick"
                    class="py-2 bg-slate-950 text-white w-full text-sm font-semibold rounded-md disabled:bg-slate-700"
                >
                    Top Up
                </Button>
            </div>
        </div>
    </main>
</template>
