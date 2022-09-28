<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
import Carousel from "@/Components/Carousel.vue";

const props = defineProps({
    novels_latest: Array,
    novels_doing: Array,
    novels_done: Array,
    user: Object,
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

        <div class="bg-white py-2 px-4 w-full sm:px-16">
            <Carousel
                name="最近更新した小説"
                :novels="novels_latest"
                :user="user"
                moreURL="/novels/more?category=最近更新した小説"
            />
            <Carousel
                name="執筆中の小説"
                :novels="novels_doing"
                :user="user"
                moreURL="/novels/more?category=執筆中の小説"
            />
            <Carousel
                name="執筆完了した小説"
                :novels="novels_done"
                :user="user"
                moreURL="/novels/more?category=執筆完了した小説"
            />
        </div>
    </BreezeAuthenticatedLayout>
</template>
