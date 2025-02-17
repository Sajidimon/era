<template>
    <Layout>
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-2xl lg:py-10">
                <h2
                    class="mb-4 text-xl font-bold text-gray-900 dark:text-white"
                >
                    Add a new product
                </h2>
                <form @submit.prevent="submit">
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <InputField
                            customClass="sm:col-span-2"
                            label="Product name"
                            type="text"
                            placeholder="Enter product name"
                            v-model="form.name"
                            :message="form.errors.name"
                        />

                        <InputField
                            customClass="w-full"
                            label="Regular price"
                            type="text"
                            placeholder="regular price"
                            v-model="form.regular"
                            :message="form.errors.regular"
                        />

                        <InputField
                            customClass="w-full"
                            label="Discount price"
                            type="text"
                            placeholder="discount price"
                            v-model="form.discount"
                        />

                        <InputField
                            customClass="w-full"
                            label="Category"
                            type="text"
                            placeholder="category name"
                            v-model="form.category"
                            :message="form.errors.category"
                        />

                        <InputField
                            customClass="w-full"
                            label="Stock"
                            type="text"
                            placeholder="Stock"
                            v-model="form.stock"
                        />

                        <textarea
                            id="message"
                            rows="8"
                            cols="20"
                            v-model="form.description"
                            class="block p-2.5 sm:col-span-2 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Write your thoughts here..."
                        ></textarea>

                        <img
                            class="w-36 h-36"
                            v-if="imagePreview || props.product.thumbnail"
                            :src="imagePreview || `/storage/${props.product.thumbnail}`"
                        />

                        <InputField
                            customClass="sm:col-span-2"
                            label="Thumbnail"
                            type="file"
                            ref="fileInput"
                            @change="handleImage"
                            :message="form.errors.thumbnail"
                        />
                    </div>
                    <button
                        type="submit"
                        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800"
                    >
                        Update product
                    </button>
                </form>
            </div>
        </section>
    </Layout>
</template>

<script setup>
import { router, useForm } from "@inertiajs/vue3";
import InputField from "../../../Components/InputField.vue";
import Layout from "../../../Layouts/Layout.vue";
import { ref } from "vue";
import { toast } from "vue3-toastify";

const props = defineProps({
    product: Object,
});

const fileInput = ref(null);
const imagePreview = ref(null);

const form = useForm({
    id:props.product.id,
    name: props.product.name,
    regular: props.product.regular,
    discount: props.product.discount,
    category: props.product.category,
    stock: props.product.stock,
    description: props.product.description,
    thumbnail: null,
    _method:'patch'
});

function handleImage(event) {
    const file = event.target.files[0];
    if (file) {
        form.thumbnail = file;
        imagePreview.value = URL.createObjectURL(file);
    }
}

function submit() {
    form.post(`/update-product/${props.product.id}`, {
        preserveScroll: true,
        onSuccess: () => {
            toast("Product Updated Successfull", { type: "success" });
            router.visit('/admin/products');
        },
    });
}
</script>
