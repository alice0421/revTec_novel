<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";

const props = defineProps({
    message: String,
    isShow: Boolean,
});
</script>

<style>
#flash_message {
    animation: FadeIn 0.5s;
}
@keyframes FadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}
.v-leave-active {
    transition: opacity 0.5s;
}
.v-leave-to {
    opacity: 0;
}
</style>

<template>
    <transition>
        <div
            id="flash_message"
            v-show="isShow"
            class="absolute bottom-0 right-0 text-sm sm:text-base text-white px-4 py-2 m-4 sm:my-4 sm:mx-8 bg-red-400 rounded-md"
        >
            {{ message }}
        </div>
    </transition>
</template>
