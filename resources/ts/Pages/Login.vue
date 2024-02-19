<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import { Ref, ref } from "vue";
import Button from "../components/Button.vue";
import ErrorMessage from "../components/ErrorMessage.vue";
import Input from "../components/Input.vue";

const loginForm = useForm({
    username: "",
    password: "",
    remember: false,
});

const error: Ref<{
    username?: string;
    password?: string;
    general?: string;
}> = ref({});

const submit = () => {
    loginForm.post("/login", {
        onError(errors) {
            error.value = errors;
        },
    });
};
</script>

<template>
    <main class="h-dvh grid justify-center">
        <section
            class="md:border rounded-md h-fit mt-12 md:mt-24 py-8 md:px-12 md:min-w-[24rem]"
        >
            <h1 class="text-2xl font-semibold text-center">Login</h1>

            <form class="mt-6" @submit.prevent="submit">
                <ErrorMessage
                    class="py-1 mb-4"
                    v-if="error.general"
                    :message="error.general"
                />
                <Input
                    v-model="loginForm.username"
                    class="mt-2"
                    label="Username"
                    id="username"
                />
                <ErrorMessage
                    class="mt-1 py-1"
                    v-if="error.username"
                    :message="error.username"
                />

                <Input
                    v-model="loginForm.password"
                    label="Password"
                    class="mt-4"
                    id="password"
                />
                <ErrorMessage
                    class="mt-1 py-1"
                    v-if="error.password"
                    :message="error.password"
                />

                <div class="flex gap-x-2 mt-4">
                    <input
                        class="accent-slate-950"
                        type="checkbox"
                        v-model="loginForm.remember"
                    />
                    <p class="text-slate-700">Remember me</p>
                </div>

                <Button variant="primary" :loading="loginForm.processing"
                    >Login</Button
                >
            </form>
            <p class="mt-6 text-slate-700 text-center">
                Didn't have account?
                <a class="text-blue-800 underline" href="/register">Register</a>
            </p>
        </section>
    </main>
</template>
