<script setup lang="ts">
import type { ShippingMethod, ShippingOption } from "../Pages/Checkout.vue";
import { formatCurrency } from "../utils";

const props = defineProps<{ shippingOptions: ShippingOption[] }>();

const shippingOptions = new Map(
    props.shippingOptions.map((option) => [option.id, option])
);

const selectedShippingOption = defineModel<ShippingOption["id"]>(
    "selectedShippingOption"
);
const selectedShippingMethod = defineModel<ShippingMethod["id"]>(
    "selectedShippingMethod"
);
</script>

<template>
    <div class="flex flex-col gap-y-4">
        <div class="flex flex-col gap-y-1">
            <label for="">Province</label>
            <select
                v-model="selectedShippingOption"
                class="p-2 rounded-md bg-white border"
            >
                <option
                    v-for="option in props.shippingOptions"
                    :key="option.id"
                    :value="option.id"
                >
                    {{ option.name }}
                </option>
            </select>
        </div>
        <div
            v-if="
                selectedShippingOption &&
                shippingOptions.get(selectedShippingOption)
            "
        >
            <p>Shipping Method</p>
            <div class="border rounded-md p-2 gap-y-2 mt-1 flex flex-col">
                <div
                    class="flex gap-x-2"
                    v-for="method of shippingOptions.get(selectedShippingOption)
                        ?.methods"
                >
                    <input
                        v-model="selectedShippingMethod"
                        class="accent-slate-950"
                        type="radio"
                        name="shippingMethod"
                        :value="method.id"
                    />
                    <label class="flex justify-between w-full" for="">
                        <span>{{ method.name }}</span>
                        <span>{{ formatCurrency(method.cost, "IDR") }}</span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</template>
