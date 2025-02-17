<template>
    <Layout>
        <section class="pb-24 relative">
            <div class="w-full max-w-7xl px-4 md:px-5 lg:px-5 mx-auto">
                <div
                    class="w-full flex-col justify-center items-center gap-4 inline-flex"
                >
                    <h2
                        class="text-center text-gray-900 text-4xl font-bold font-manrope leading-normal"
                    >
                        Order Form
                    </h2>
                    <p
                        class="text-center text-gray-500 text-base font-normal leading-relaxed"
                    >
                        Enter Order details for goods or services purchased by
                        customers.
                    </p>
                </div>
                <form @submit.prevent="submit">
                    <div
                        class="lg:my-14 my-8 grid lg:grid-cols-2 grid-cols-1 gap-8"
                    >
                        <div
                            class="w-full flex-col justify-start items-start gap-6 inline-flex"
                        >
                            <h4
                                class="text-gray-900 text-xl font-semibold leading-8"
                            >
                                Basic Information
                            </h4>
                            <div
                                class="w-full flex-col justify-start items-start gap-8 flex"
                            >
                                <InputField
                                    customClass="w-full"
                                    label="Name"
                                    type="text"
                                    v-model="form.name"
                                    :message="form.errors.name"
                                />

                                <div class="block w-full">
                                    <label
                                        class="block mb-2 text-sm font-medium text-gray-600 w-full"
                                        >Select Funnel</label
                                    >
                                    <select
                                        v-model="form.sales_funnel_id"
                                        @change="updateTotal"
                                        class="h-12 border border-gray-300 text-gray-600 text-base rounded-lg block w-full py-2.5 px-4 focus:outline-none"
                                    >
                                        <option selected disabled>
                                            Choose a Funnel
                                        </option>
                                        <option
                                            v-for="funnel in funnels"
                                            :key="funnel.id"
                                            :value="funnel.id"
                                        >
                                            {{ funnel.title }}
                                        </option>
                                    </select>
                                    <div
                                        v-if="form.errors.sales_funnel_id"
                                        class="text-red-500"
                                    >
                                        <p>choose funnel</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="w-full flex-col justify-start items-start gap-6 inline-flex"
                        >
                            <h4
                                class="text-gray-900 text-xl font-semibold leading-8"
                            >
                                Address Informatiom
                            </h4>
                            <div
                                class="w-full flex-col justify-start items-start gap-8 flex"
                            >
                                <InputField
                                    customClass="w-full"
                                    label="Address"
                                    type="text"
                                    v-model="form.address"
                                    :message="form.errors.address"
                                />

                                <InputField
                                    customClass="w-full"
                                    label="Phone"
                                    type="text"
                                    v-model="form.phone"
                                    :message="form.errors.phone"
                                />
                                <div class="block w-full">
                                    <label
                                        class="block mb-2 text-sm font-medium text-gray-600 w-full"
                                        >Status</label
                                    >
                                    <select
                                        v-model="form.status"
                                        class="h-12 border border-gray-300 text-gray-600 text-base rounded-lg block w-full py-2.5 px-4 focus:outline-none"
                                    >
                                        <option selected disabled>
                                            Choose a status
                                        </option>
                                        <option value="pending">pending</option>
                                        <option value="completed">
                                            completed
                                        </option>
                                        <option value="declined">
                                            declined
                                        </option>
                                    </select>
                                    <div
                                        v-if="form.errors.status"
                                        class="text-red-500"
                                    >
                                        <p>choose status</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button
                        class="mx-auto sm:w-fit w-full px-7 py-3 bg-indigo-600 hover:bg-indigo-700 transition-all duration-700 ease-in-out rounded-xl shadow-[0px_1px_2px_0px_rgba(16,_24,_40,_0.05)] justify-center items-center flex"
                    >
                        <span
                            class="px-2 text-center text-white text-lg font-semibold leading-8"
                            >Order Now (
                            {{ form.total || props.order.total }} TK )</span
                        >
                    </button>
                </form>
            </div>
        </section>
    </Layout>
</template>

<script setup>
import Layout from "@/Layouts/Layout.vue";
import InputField from "@/components/InputField.vue";
import { useForm } from "@inertiajs/vue3";
import { ref, watch } from "vue";
import { toast } from "vue3-toastify";

const props = defineProps({
    funnels: Array,
    order: Object,
});

const total = ref(0);

const form = useForm({
    id: props.order.id,
    name: props.order.name,
    phone: props.order.phone,
    address: props.order.address,
    total: total.value,
    status: props.order.status,
    sales_funnel_id: props.order.sales_funnel_id,
    _method: "patch",
});

const updateTotal = () => {
    const selectedFunnel = props.funnels.find(
        (funnel) => funnel.id === form.sales_funnel_id
    );
    if (selectedFunnel && selectedFunnel.products) {
        form.total = selectedFunnel.products.reduce(
            (sum, product) =>
                sum +
                (product.discount
                    ? parseFloat(product.discount)
                    : parseFloat(product.regular)),
            0
        );
    } else {
        form.total = 0;
    }
};

const submit = () => {
    form.post(`/update-order/${props.order.id}`, {
        preserveScroll: true,
        onSuccess: () => {
            toast.success("Order Updated successfully");
        },
        onError: () => {
            toast.error("Failed to update order");
        },
    });
};
</script>
