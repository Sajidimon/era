<template>
    <Layout>
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-2xl lg:py-10">
                <h2
                    class="mb-4 text-xl font-bold text-gray-900 dark:text-white"
                >
                    Create new Funnel
                </h2>
                <form @submit.prevent="submit">
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <InputField
                            customClass="sm:col-span-2"
                            label="Funnel title"
                            type="text"
                            placeholder="Enter name"
                            v-model="form.title"
                            :message="form.errors.title"
                        />
                        <InputField
                            customClass="sm:col-span-2"
                            label="Funnel sub heading"
                            type="text"
                            placeholder="Enter sub heading"
                            v-model="form.subheading"
                            :message="form.errors.subheading"
                        />

                        <img
                            class="w-36 h-36"
                            v-if="imagePreview"
                            :src="imagePreview"
                        />

                        <InputField
                            customClass="sm:col-span-2"
                            label="Promotional Image"
                            type="file"
                            ref="fileInput"
                            @change="handleImage"
                            :message="form.errors.image"
                        />
                    </div>

                    <h3
                        class="my-4 font-semibold text-gray-900 dark:text-white"
                    >
                        Select product
                    </h3>
                    <ul
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    >
                        <li
                            v-for="product in products.slice(0, 8)"
                            :key="product.id"
                            class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600"
                        >
                            <Checkbox
                                v-model="form.product_ids"
                                :label="product.name"
                                :value="product.id"
                                :message="form.errors.product_ids"
                            />
                        </li>
                    </ul>

                    <button
                        type="submit"
                        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800"
                    >
                        Create Funnel
                    </button>
                </form>
            </div>
        </section>
    </Layout>
</template>

<script setup>
import { router, useForm } from "@inertiajs/vue3";
import InputField from "../../../Components/InputField.vue";
import Checkbox from "@/Components/Checkbox.vue";
import Layout from "../../../Layouts/Layout.vue";
import { ref } from "vue";
import { toast } from "vue3-toastify";

const imagePreview = ref(null);
const selectedProducts = ref([]);

const props = defineProps({
    products: Array,
});

const form = useForm({
    title: "",
    subheading: "",
    image: null,
    product_ids: selectedProducts,
});

function handleImage(event) {
    const file = event.target.files[0];
    if (file) {
        form.image = file;
        imagePreview.value = URL.createObjectURL(file);
    }
}

function submit() {
    form.post("/create-funnel", {
        preserveScroll: true,
        onSuccess: () => {
            toast("Funnel Created Successfully", { type: "success" });
           router.visit("/admin/funnels");
        },
    });
}
</script>
