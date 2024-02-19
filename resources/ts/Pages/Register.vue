<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import Button from "../components/Button.vue";
import ErrorMessage from "../components/ErrorMessage.vue";
import Input from "../components/Input.vue";

const registerForm = useForm({
    username: "",
    password: "",
});

const error = ref<{ username?: string; password?: string; general?: string }>(
    {}
);

const submit = () => {
    registerForm.post("/register", {
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
            <h1 class="text-2xl font-semibold text-center">Register</h1>
            <form @submit.prevent="submit">
                <Input
                    v-model="registerForm.username"
                    class="mt-8"
                    label="Username"
                    id="username"
                />
                <ErrorMessage
                    class="mt-1 py-1"
                    v-if="error.username"
                    :message="error.username"
                />
                <Input
                    v-model="registerForm.password"
                    label="Password"
                    class="mt-4"
                    id="password"
                />
                <ErrorMessage
                    class="mt-1 py-1"
                    v-if="error.password"
                    :message="error.password"
                />
                <Button :loading="registerForm.processing" variant="primary"
                    >Register</Button
                >
            </form>
            <p class="mt-6 text-slate-700 text-center">
                Already have account?
                <a class="text-blue-800 underline" href="/login">Login</a>
            </p>
        </section>
    </main>
</template>
