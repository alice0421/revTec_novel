<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";

defineProps({
    novels: Array,
});
</script>

<template>
    <Head title="Novels" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                小説一覧
            </h2>
        </template>
        <div class="bg-white py-2 px-2 h-full sm:px-4 lg:px-6">
            ここに小説が並ぶ
            <div v-for="novel in novels" :key="novel.id">
                <p>{{ novel.title }}：{{ novel.body }}</p>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
