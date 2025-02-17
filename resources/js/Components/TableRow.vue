<template>
    <tr
        class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700"
    >
        <th
            scope="row"
            class="flex items-center px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"
        >
            <img :src="thumbnail" class="w-auto h-8 mr-3" />
            {{ name }}
        </th>
        <td class="px-4 py-2">
            <span
                class="bg-primary-100 text-primary-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-primary-900 dark:text-primary-300"
                >{{ category }}</span
            >
        </td>
        <td v-if="price"
            class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"
        >
            <div class="flex items-center">
                {{ price }}
            </div>
        </td>
        <td v-if="stock"
            class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"
        >
            {{ stock }}
        </td>
        <td v-if="status" class="px-4 py-2">
            <span
                :class="statusClass"
                >{{ status }}</span
            >
        </td>
        <td
            class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"
        >
            {{ time }}
        </td>
        <td
            class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"
        >
            <Link v-if="viewLink" :href="viewLink" class="bg-green-600 text-white py-1 px-3 rounded mr-2"
                >View</Link
            >
            <Link v-if="editLink" :href="editLink" class="bg-blue-400 text-white py-1 px-3 rounded mr-2"
                >Edit</Link
            >
            <button v-if="deleteProduct" @click="deleteProduct" class="bg-red-400 text-white py-1 px-3 rounded"
                >Delete</button
            >
        </td>
    </tr>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    viewLink: {
        type:String,
    },
    editLink: {
        type:String,
    },
    thumbnail: {
        type: String,
    },
    name: {
        type: String,
    },
    category: {
        type: String,
    },
    status: {
        type: String,
    },
    price: {
        type: String,
    },
    stock: {
        type: String,
    },
    time: {
        type: String,
    },
    deleteProduct: {
        type:Function,
    }
});


const statusClass = computed(() => {
    switch(props.status) {
        case 'pending':
            return 'bg-yellow-100 text-yellow-800 text-primary-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-primary-900 dark:text-primary-300';
        case 'completed':
            return 'bg-green-100 text-green-800 text-primary-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-primary-900 dark:text-primary-300';
        case 'declined':
            return 'bg-red-100 text-red-800 text-primary-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-primary-900 dark:text-primary-300';
        default:
            return 'bg-primary-100 text-primary-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-primary-900 dark:text-primary-300';
    }
})


</script>
