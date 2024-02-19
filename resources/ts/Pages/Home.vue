<script setup lang="ts">
import Button from "../components/Button.vue";
import ProductCard from "../components/ProductCard.vue";
import SearchBar from "../components/SearchBar.vue";
import { ShoppingCart } from "../components/icons";

export interface Product {
    id: string;
    name: string;
    price: number;
    picture: string;
    stock: number;
}

const props = defineProps<{ products: Product[] }>();
</script>

<template>
    <main class="container">
        <nav
            class="fixed flex container w-full bg-white h-20 items-center gap-x-4 top-0 z-50"
        >
            <SearchBar placeholder="Search" class="max-w-[32rem] w-full" />
            <a href="/cart">
                <button
                    class="rounded-full p-2 text-slate-950 hover:bg-slate-50 border"
                >
                    <ShoppingCart />
                </button>
            </a>
        </nav>

        <div class="flex gap-x-4 mt-20">
            <section class="w-full">
                <ul class="flex flex-wrap gap-y-4 gap-x-8">
                    <li
                        :key="product.id"
                        v-for="product in props.products"
                        class="w-[14rem]"
                    >
                        <ProductCard :product="product" />
                    </li>
                </ul>
            </section>
        </div>
    </main>
</template>
