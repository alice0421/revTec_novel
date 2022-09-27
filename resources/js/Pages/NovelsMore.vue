<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
import NovelDetailsModal from "@/Components/NovelDetailsModal.vue";

const props = defineProps({
    novels: Array,
    user: Object,
});
</script>

<template>
    <Head title="NovelsMore" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                最近更新した小説
            </h2>
        </template>
        <div class="bg-white py-2 px-4 w-full h-full sm:px-16">
            <p>テスト！</p>
        </div>
    </BreezeAuthenticatedLayout>
</template>
