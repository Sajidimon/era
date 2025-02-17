<template>
    <section class="flex justify-center relative">
        <img
            src="https://pagedone.io/asset/uploads/1702362010.png"
            alt="gradient background image"
            class="w-full h-full object-cover fixed"
        />
        <div class="mx-auto max-w-lg px-6 lg:px-8 absolute py-20">
            <div class="rounded-2xl bg-white shadow-xl">
                <form @submit.prevent="submit" class="lg:p-11 p-7 mx-auto">
                    <div class="mb-11">
                        <h1
                            class="text-gray-900 text-center font-manrope text-3xl font-bold leading-10 mb-2"
                        >
                            Welcome
                        </h1>
                        <p
                            class="text-gray-500 text-center text-base font-medium leading-6"
                        >
                            Create your account to get started
                        </p>
                    </div>
                    <input
                        type="text"
                        v-model="form.name"
                        class="w-full h-12 text-gray-900 placeholder:text-gray-400 text-lg font-normal leading-7 rounded-full border-gray-300 border shadow-sm focus:outline-none px-4 mb-1"
                        placeholder="Username"
                    />
                    <div v-if="form.errors.name"><p class="text-red-500">{{ form.errors.name }}</p></div>
                    <input
                        type="email"
                        v-model="form.email"
                        class="w-full h-12 text-gray-900 placeholder:text-gray-400 text-lg font-normal leading-7 rounded-full border-gray-300 border shadow-sm focus:outline-none px-4 mb-1 mt-6"
                        placeholder="Email"
                    />
                    <div v-if="form.errors.email"><p class="text-red-500">{{ form.errors.email }}</p></div>
                    <input
                        type="password"
                        v-model="form.password"
                        class="w-full h-12 text-gray-900 placeholder:text-gray-400 text-lg font-normal leading-7 rounded-full border-gray-300 border shadow-sm focus:outline-none px-4 mb-1 mt-6"
                        placeholder="Password"
                    />
                    <div v-if="form.errors.password"><p class="text-red-500">{{ form.errors.password }}</p></div>
                    <input
                        type="password"
                        v-model="form.password_confirmation"
                        class="w-full h-12 text-gray-900 placeholder:text-gray-400 text-lg font-normal leading-7 rounded-full border-gray-300 border shadow-sm focus:outline-none px-4 mt-6"
                        placeholder="Confirm Password"
                    />
                    <div v-if="form.errors.password_confirmation"><p class="text-red-500">{{ form.errors.password_confirmation }}</p></div>
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="w-full mt-6 h-12 text-white text-center text-base font-semibold leading-6 rounded-full hover:bg-indigo-800 transition-all duration-700 bg-indigo-600 shadow-sm mb-11"
                    >
                        Registration
                    </button>
                    <Link
                        href="/login"
                        class="flex justify-center text-gray-900 text-base font-medium leading-6"
                    >
                        Already have an account?
                        <span class="text-indigo-600 font-semibold pl-3">
                            Log In</span
                        >
                    </Link>
                </form>
            </div>
        </div>
    </section>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import { toast } from "vue3-toastify";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post("/register", {
        onSuccess: () => {
            toast.success("Registration successful");
        },
        onError: () => {
            toast.error("Registration failed");
        },
    });
};
</script>
