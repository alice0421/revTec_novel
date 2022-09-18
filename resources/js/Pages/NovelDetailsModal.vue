<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { ref } from "vue";

const emit = defineEmits(["showNovelDetails"]);
</script>

<template>
    <div @click="$emit('showNovelDetails', '!showNovelDetails')">
        <div>
            <p>{{ emit.showNovelDetails }}: モーダルウィンドが表示されました</p>
        </div>
    </div>
</template>
