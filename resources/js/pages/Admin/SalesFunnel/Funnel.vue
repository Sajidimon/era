<template>
    <Layout>
        <section class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
            <div class="px-4 mx-auto max-w-screen-2xl lg:px-12">
                <div
                    class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg"
                >
                    <div
                        class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4"
                    >
                        <div class="flex items-center flex-1 space-x-4">
                            <h5>
                                <span class="text-gray-500 mr-1"
                                    >All Funnel:</span
                                >
                                <span class="dark:text-white">{{
                                    funnels.data?.length
                                }}</span>
                            </h5>
                        </div>
                        <div
                            class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3"
                        >
                            <Link
                                as="button"
                                href="/admin/create-funnel"
                                class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800"
                            >
                                <i class="fas fa-plus mr-2"></i>
                                Create new Funnel
                            </Link>
                        </div>
                    </div>
                    <div v-if="funnels.data?.length > 0">
                        <div class="overflow-x-auto">
                            <table
                                class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                            >
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                                >
                                    <tr>
                                        <th scope="col" class="px-4 py-3">
                                            Funnel Name
                                        </th>
                                        <th scope="col" class="px-4 py-3">
                                            Total Product
                                        </th>
                                        <th scope="col" class="px-4 py-3">
                                            Last Update
                                        </th>
                                        <th scope="col" class="px-4 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <TableRow
                                        v-for="funnel in funnels.data"
                                        :key="funnel.id"
                                        :viewLink="`/funnel/${funnel.title.replace(/ /g, '-')}`"
                                        :editLink="`/funnel/${funnel.id}/edit`"
                                        :thumbnail="`/storage/${funnel.image}`"
                                        :name="funnel.title"
                                        :category="
                                            funnel.products?.length +
                                            ' Products'
                                        "
                                        :time="createdDate(funnel.created_at)"
                                        :deleteProduct="
                                            () => deleteProduct(funnel.id)
                                        "
                                    />
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div v-else>
                        <p class="text-center">
                            No Funnel found. Create first
                        </p>
                    </div>
                    <nav
                        class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                        aria-label="Table navigation"
                    >
                        <span
                            class="text-sm font-normal text-gray-500 dark:text-gray-400"
                        >
                            Showing
                            <span
                                class="font-semibold text-gray-900 dark:text-white"
                                >{{ funnels.from }}-{{ funnels.to }}</span
                            >
                            of
                            <span
                                class="font-semibold text-gray-900 dark:text-white"
                                >{{ funnels.total }}</span
                            >
                        </span>
                        <div class="inline-flex items-stretch -space-x-px">
                            <template
                                v-for="(link, index) in funnels.links"
                                :key="index"
                            >
                                <Link
                                    v-if="link.url"
                                    :href="link.url"
                                    class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                    :class="{
                                        'bg-gray-200 dark:bg-gray-600 text-gray-700 dark:text-white font-bold':
                                            link.active,
                                    }"
                                >
                                    <span v-html="link.label"></span>
                                </Link>
                                <span
                                    v-else
                                    class="flex items-center justify-center text-sm py-2 px-3 leading-tight text-gray-400 bg-gray-100 border border-gray-300 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-500"
                                >
                                    <span v-html="link.label"></span>
                                </span>
                            </template>
                        </div>
                    </nav>
                </div>
            </div>
        </section>
    </Layout>
</template>

<script setup>
import TableRow from "@/components/TableRow.vue";
import Layout from "../../../Layouts/Layout.vue";
import { router } from "@inertiajs/vue3";
import Swal from "sweetalert2";

const props = defineProps({
    funnels: Object,
});

function createdDate(createdTime) {
    return new Date(createdTime).toLocaleDateString("en-US", {
        year: "numeric",
        month: "long",
        day: "numeric",
    });
}

function deleteProduct(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(`/delete-funnel/${id}`, {
                onSuccess: () => {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your Funnel has been deleted.",
                        icon: "success",
                    });
                },
            });
        }
    });
}
</script>
