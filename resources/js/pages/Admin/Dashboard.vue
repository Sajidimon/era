<template>
    <Layout>
        <div
            class="grid grid-cols-1 gap-4 px-4 mt-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 sm:px-8"
        >
            <div
                class="flex items-center bg-white border rounded-sm overflow-hidden shadow"
            >
                <div class="p-7 bg-green-400">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="px-4 text-gray-700">
                    <h3 class="text-sm tracking-wider">Total Products</h3>
                    <p class="text-3xl">
                        {{ products.length > 0 ? products.length : 0 }}
                    </p>
                </div>
            </div>
            <div
                class="flex items-center bg-white border rounded-sm overflow-hidden shadow"
            >
                <div class="p-7 bg-blue-400">
                    <i class="fas fa-filter"></i>
                </div>
                <div class="px-4 text-gray-700">
                    <h3 class="text-sm tracking-wider">Total Funnel</h3>
                    <p class="text-3xl">
                        {{ funnels.length > 0 ? funnels.length : 0 }}
                    </p>
                </div>
            </div>
            <div
                class="flex items-center bg-white border rounded-sm overflow-hidden shadow"
            >
                <div class="p-7 bg-indigo-400">
                    <i class="fas fa-box"></i>
                </div>
                <div class="px-4 text-gray-700">
                    <h3 class="text-sm tracking-wider">Total Order</h3>
                    <p class="text-3xl">
                        {{ orders.length > 0 ? orders.length : 0 }}
                    </p>
                </div>
            </div>
            <div
                class="flex items-center bg-white border rounded-sm overflow-hidden shadow"
            >
                <div class="p-7 bg-indigo-400">
                    <i class="fas fa-box"></i>
                </div>
                <div class="px-4 text-gray-700">
                    <h3 class="text-sm tracking-wider">Pending Order</h3>
                    <p class="text-3xl">
                        {{ pending.length > 0 ? pending.length : 0 }}
                    </p>
                </div>
            </div>
            <div
                class="flex items-center bg-white border rounded-sm overflow-hidden shadow"
            >
                <div class="p-7 bg-indigo-400">
                    <i class="fas fa-box"></i>
                </div>
                <div class="px-4 text-gray-700">
                    <h3 class="text-sm tracking-wider">Completed Order</h3>
                    <p class="text-3xl">
                        {{ completed.length > 0 ? completed.length : 0 }}
                    </p>
                </div>
            </div>
            <div
                class="flex items-center bg-white border rounded-sm overflow-hidden shadow"
            >
                <div class="p-7 bg-indigo-400">
                    <i class="fas fa-box"></i>
                </div>
                <div class="px-4 text-gray-700">
                    <h3 class="text-sm tracking-wider">Cancelled Order</h3>
                    <p class="text-3xl">
                        {{ cancelled.length > 0 ? cancelled.length : 0 }}
                    </p>
                </div>
            </div>
        </div>

        <section class="mt-5 dark:bg-gray-900 py-3 sm:py-5">
            <div class="px-4 mx-auto max-w-screen-2xl lg:px-10">
                <div
                    class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg"
                >
                    <div
                        class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4"
                    >
                        <div class="flex items-center flex-1 space-x-4">
                            <h5>
                                <span class="text-gray-500 mr-1"
                                    >Recent orders:</span
                                >
                                <span class="dark:text-white">{{
                                    orders.length
                                }}</span>
                            </h5>
                        </div>
                        <div
                            class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3"
                        >
                        </div>
                    </div>
                    <div v-if="orders.length > 0">
                        <div class="overflow-x-auto">
                            <table
                                class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                            >
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                                >
                                    <tr>
                                        <th scope="col" class="px-4 py-3">
                                            Order ID
                                        </th>
                                        <th scope="col" class="px-4 py-3">
                                            Customer Name
                                        </th>
                                        <th scope="col" class="px-4 py-3">
                                            Total Amount
                                        </th>
                                        <th scope="col" class="px-4 py-3">
                                            Customer Phone
                                        </th>
                                        <th scope="col" class="px-4 py-3">
                                            Status
                                        </th>
                                        <th scope="col" class="px-4 py-3">
                                            Order Date
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <TableRow
                                        v-for="order in orders.slice(0, 5)"
                                        :key="order.id"
                                        :name="order.id + '#'"
                                        :category="order.name"
                                        :stock="order.phone"
                                        :price="order.total + ' ' + 'TK'"
                                        :status="order.status"
                                        :time="createdDate(order.created_at)"
                                    />
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div v-else>
                        <p class="text-center mb-10">
                            No Order found. Please create one.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </Layout>
</template>

<script setup>
import Layout from "../../Layouts/Layout.vue";
import TableRow from "../../Components/TableRow.vue";

const props = defineProps({
    products: Array,
    funnels: Array,
    orders: Array,
});

function createdDate(createdTime) {
    return new Date(createdTime).toLocaleDateString("en-US", {
        year: "numeric",
        month: "long",
        day: "numeric",
    });
}

const pending = props.orders.filter((order) => order.status === "pending");
const completed = props.orders.filter((order) => order.status === "completed");
const cancelled = props.orders.filter((order) => order.status === "declined");
</script>
