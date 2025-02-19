<template>
    <div v-if="funnel">
        <section class="bg-white py-8 antialiased dark:bg-gray-900 md:pt-16">
            <div
                class="mx-auto grid max-w-screen-xl px-4 pb-8 md:grid-cols-12 lg:gap-12 lg:pb-16 xl:gap-0"
            >
                <div
                    class="content-center justify-self-start md:col-span-7 md:text-start"
                >
                    <h1
                        class="mb-4 text-4xl font-extrabold leading-none tracking-tight dark:text-white md:max-w-2xl md:text-5xl xl:text-6xl"
                    >
                        {{ funnel.title }}
                    </h1>
                    <p
                        class="mb-4 max-w-2xl text-gray-500 dark:text-gray-400 md:mb-12 md:text-lg lg:mb-5 lg:text-xl"
                    >
                        {{ funnel.subheading }}
                    </p>
                    <a
                        href="#checkout"
                        class="inline-block scroll-smooth rounded-lg bg-primary-700 px-6 py-3.5 text-center font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                        >Order Now</a
                    >
                </div>
                <div class="md:col-span-5 md:mt-0 md:flex">
                    <img
                        class="dark:hidden"
                        :src="`/storage/${funnel.image}`"
                        alt="shopping illustration"
                    />
                </div>
            </div>
        </section>

        <section
            v-if="funnel.products?.length > 0"
            class="bg-white pb-12 text-gray-700 sm:py-16 lg:pb-20"
        >
            <div class="mx-auto max-w-screen-xl px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-md text-center">
                    <h2 class="font-serif text-2xl font-bold sm:text-3xl">
                        Our Products
                    </h2>
                </div>

                <div
                    class="mt-10 grid grid-cols-2 gap-6 sm:grid-cols-4 sm:gap-4 lg:mt-16"
                >
                    <article
                        v-for="product in funnel.products"
                        :key="product.id"
                        class="relative flex flex-col overflow-hidden rounded-lg border"
                    >
                        <div class="aspect-square overflow-hidden">
                            <img
                                class="h-full w-full object-cover transition-all duration-300 group-hover:scale-125"
                                :src="`/storage/${product.thumbnail}`"
                                alt=""
                            />
                        </div>
                        <div class="absolute top-0 m-2 rounded-full bg-white">
                            <p
                                class="rounded-full bg-emerald-500 p-1 text-[8px] font-bold uppercase tracking-wide text-white sm:py-1 sm:px-3"
                            >
                                Sale
                            </p>
                        </div>
                        <div
                            class="my-4 mx-auto flex w-10/12 flex-col items-start justify-between"
                        >
                            <div class="mb-2 flex">
                                <p class="mr-3 text-sm font-semibold">
                                    {{ product.discount }} TK
                                </p>
                                <del class="text-xs text-gray-400">
                                    {{ product.regular ? product.regular : "" }}
                                    TK
                                </del>
                            </div>
                            <h3 class="mb-2 text-sm text-gray-400">
                                {{ product.category }}
                            </h3>
                        </div>
                        <button
                            class="group mx-auto mb-2 flex h-10 w-10/12 items-stretch overflow-hidden rounded-md text-gray-600"
                        >
                            <div
                                class="flex w-full items-center justify-center bg-gray-100 text-xs uppercase transition group-hover:bg-emerald-600 group-hover:text-white"
                            >
                                <a href="#checkout">Order Now</a>
                            </div>
                        </button>
                    </article>
                </div>
            </div>
        </section>

        <section
            v-if="funnel.products?.length > 0"
            class="bg-white px-4 py-8 antialiased dark:bg-gray-900 md:pt-16"
        >
            <div
                class="mx-auto grid max-w-screen-xl rounded-lg bg-gray-50 p-4 dark:bg-gray-800 md:p-8 lg:grid-cols-12 lg:gap-8 lg:p-16 xl:gap-16"
            >
                <div class="lg:col-span-5 lg:mt-0">
                    <a href="#">
                        <img
                            class="mb-4 h-56 w-56 dark:hidden sm:h-96 sm:w-96 md:h-full md:w-full"
                            :src="`/storage/${funnel.products[0].thumbnail}`"
                            alt="product image"
                        />
                        <img
                            class="mb-4 hidden dark:block md:h-full"
                            :src="`/storage/${funnel.products[0].thumbnail}`"
                            alt="product image"
                        />
                    </a>
                </div>
                <div class="me-auto place-self-center lg:col-span-7">
                    <h1
                        class="mb-3 text-2xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white md:text-4xl"
                    >
                        {{ funnel.products[0].name }}
                    </h1>
                    <p class="mb-6 text-gray-500 dark:text-gray-400">
                        {{ funnel.products[0].description }}
                    </p>
                    <a
                        href="#checkout"
                        class="inline-flex items-center justify-center rounded-lg bg-primary-700 px-5 py-3 text-center text-base font-medium text-white hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900"
                    >
                        Order now
                    </a>
                </div>
            </div>
        </section>

        <section
            v-if="funnel.products?.length > 1"
            class="bg-white px-4 py-8 antialiased dark:bg-gray-900 md:pb-16"
        >
            <div
                class="mx-auto grid max-w-screen-xl rounded-lg bg-gray-50 p-4 dark:bg-gray-800 md:p-8 lg:grid-cols-12 lg:gap-8 lg:p-16 xl:gap-16"
            >
                <div class="me-auto place-self-center lg:col-span-7">
                    <h1
                        class="mb-3 text-2xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white md:text-4xl"
                    >
                        {{ funnel.products[1].name }}
                    </h1>
                    <p class="mb-6 text-gray-500 dark:text-gray-400">
                        {{ funnel.products[1].description }}
                    </p>
                    <a
                        href="#checkout"
                        class="inline-flex items-center justify-center rounded-lg bg-primary-700 px-5 py-3 text-center text-base font-medium text-white hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900"
                    >
                        Order now
                    </a>
                </div>
                <div class="lg:col-span-5 lg:mt-0">
                    <a href="#">
                        <img
                            class="mb-4 h-56 w-56 dark:hidden sm:h-96 sm:w-96 md:h-full md:w-full"
                            :src="`/storage/${funnel.products[1].thumbnail}`"
                            alt="peripherals"
                        />
                        <img
                            class="mb-4 hidden dark:block md:h-full"
                            :src="`/storage/${funnel.products[1].thumbnail}`"
                            alt="peripherals"
                        />
                    </a>
                </div>
            </div>
        </section>

        <section
            id="checkout"
            class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16"
        >
            <form
                @submit.prevent="submit"
                class="mx-auto max-w-screen-xl px-4 2xl:px-0"
            >
                <div
                    class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12 xl:gap-16"
                >
                    <div class="min-w-0 flex-1 space-y-8">
                        <div class="space-y-4">
                            <h2
                                class="text-xl font-semibold text-gray-900 dark:text-white"
                            >
                                Delivery Details
                            </h2>

                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <InputField
                                    customClass="w-full"
                                    label="Your Name"
                                    type="text"
                                    placeholder="Enter your name"
                                    v-model="form.name"
                                    :message="form.errors.name"
                                />
                                <InputField
                                    customClass="w-full"
                                    label="Mobile number"
                                    type="text"
                                    placeholder="Enter your number"
                                    v-model="form.phone"
                                    :message="form.errors.phone"
                                />
                                <InputField
                                    customClass="sm:col-span-2"
                                    label="Your Full Address"
                                    type="text"
                                    placeholder="Enter your address"
                                    v-model="form.address"
                                    :message="form.errors.address"
                                />
                            </div>
                        </div>

                        <div class="space-y-4">
                            <h3
                                class="text-xl font-semibold text-gray-900 dark:text-white"
                            >
                                Payment
                            </h3>
                            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                                <div
                                    class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800"
                                >
                                    <div class="flex items-start">
                                        <div class="flex h-5 items-center">
                                            <input
                                                id="pay-on-delivery"
                                                aria-describedby="pay-on-delivery-text"
                                                type="radio"
                                                name="payment-method"
                                                value=""
                                                checked
                                                class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600"
                                            />
                                        </div>

                                        <div class="ms-4 text-sm">
                                            <label
                                                for="pay-on-delivery"
                                                class="font-medium leading-none text-gray-900 dark:text-white"
                                            >
                                                Payment on delivery
                                            </label>
                                            <p
                                                id="pay-on-delivery-text"
                                                class="mt-1 text-xs font-normal text-gray-500 dark:text-gray-400"
                                            >
                                                Pay upon Cash on delivery
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="mt-6 w-full space-y-6 sm:mt-8 lg:mt-0 lg:max-w-xs xl:max-w-md"
                    >
                        <div class="flow-root">
                            <div
                                class="-my-3 divide-y divide-gray-200 dark:divide-gray-800"
                            >
                                <dl
                                    class="flex items-center justify-between gap-4 py-3"
                                >
                                    <dt
                                        class="text-base font-normal text-gray-500 dark:text-gray-400"
                                    >
                                        Payment Method
                                    </dt>
                                    <dd
                                        class="text-base font-medium text-gray-900 dark:text-white"
                                    >
                                        Cash on Delivery
                                    </dd>
                                </dl>

                                <dl
                                    class="flex items-center justify-between gap-4 py-3"
                                >
                                    <dt
                                        class="text-base font-bold text-gray-900 dark:text-white"
                                    >
                                        Total
                                    </dt>
                                    <dd
                                        class="text-base font-bold text-gray-900 dark:text-white"
                                    >
                                        {{ total }} TK
                                    </dd>
                                </dl>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                            >
                                <i class="fa fa-shopping-cart mr-2"></i>
                                Order Now
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
    <div v-else class="">
        <p>No Funnel created...</p>
    </div>
</template>

<script setup>
import InputField from "@/Components/InputField.vue";
import { useForm } from "@inertiajs/vue3";
import { computed } from "vue";
import { toast } from "vue3-toastify";

const props = defineProps({
    funnel: Object,
});

const total = computed(() => {
    if (!props.funnel || !props.funnel.products) return 0;
    return props.funnel.products.reduce(
        (sum, product) =>
            sum +
            (product.discount
                ? parseFloat(product.discount)
                : parseFloat(product.regular)),
        0
    );
});

const form = useForm({
    name: "",
    phone: "",
    address: "",
    total: total,
    sales_funnel_id: props.funnel?.id,
});

function submit() {
    form.post("/create-order", {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            toast('Order placed successfully', {type: 'success'});
        },
        onError: () => {
            toast('Your order is failed', {type: 'error'});
        },
    });
}
</script>
