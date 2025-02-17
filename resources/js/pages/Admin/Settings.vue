<template>
    <Layout>
        <div class="flex flex-col gap-2">
            <form @submit.prevent="submit">
                <div>
                    <label class="inline-flex items-center">
                        <input
                            type="checkbox"
                            class="w-4 h-4 accent-indigo-700"
                            v-model="form.disabled_registration"
                            :checked="Boolean(form.disabled_registration)"
                        />
                        <span class="ml-2">Disable Registration</span>
                    </label>
                </div>
                <div>
                    <button
                        type="submit"
                        class="mt-6 py-3 px-4 text-white text-center text-base font-semibold leading-6 rounded-full hover:bg-indigo-800 transition-all duration-700 bg-indigo-600 shadow-sm mb-11"
                        :disabled="form.processing"
                    >
                        Update Settings
                    </button>
                </div>
            </form>
        </div>
    </Layout>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import Layout from "../../Layouts/Layout.vue";
import { toast } from "vue3-toastify";

const props = defineProps({
    settings: {
        type: Object,
    }
});

const form = useForm({
    disabled_registration: Boolean(props.settings?.disabled_registration),
    _method: "patch",
});

function submit() {
    form.post("/update-settings", {
        preserveScroll: true,
        onSuccess: () => {
            toast.success("Settings updated successfully");
        },
        onError: () => {
            toast.error("Failed to update settings");
        },
    });
}
</script>
