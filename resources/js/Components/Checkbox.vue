<template>
    <div class="flex items-center ps-3">
        <input
            id="vue-checkbox-list"
            v-model="model"
            type="checkbox"
            :value="value"
            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
        />
        <label
            for="vue-checkbox-list"
            class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
            >{{ label }}</label
        >
        <p>{{ message }}</p>
    </div>
</template>

<script setup>

const model = defineModel();

defineProps({
    label:String,
    value: Number,
    message:String,
})
</script>


