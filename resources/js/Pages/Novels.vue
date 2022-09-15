<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";

defineProps({
    novels: Array,
});

function showPreview(txt) {
    let txtTmp = txt;
    txtTmp = txtTmp
        .replace(
            /[\|｜][＃|#]([　,.ー―-！？!?～~・、。"'”’％%＠@（）()｛｝{}「」：；:;/／￥0-9０-９A-zＡ-ｚ一-龠ぁ-んァ-ヶ]+?)[＃|#]/g,
            "<span class='font-bold text-xl'>$1</span>"
        )
        .replace(
            /[\|｜]([　,.ー―-！？!?～~・、。"'”’％%＠@（）()｛｝{}「」：；:;/／￥0-9０-９A-zＡ-ｚ一-龠ぁ-んァ-ヶ]+)《([　,.ー―-！？!?～~・、。"'”’％%＠@（）()｛｝{}「」：；:;/／￥0-9０-９A-zＡ-ｚ一-龠ぁ-んァ-ヶ]+?)》/g,
            "<ruby>$1<rt>$2</rt></ruby>"
        )
        .replace(
            /[\|｜]【([　,.ー―-！？!?～~・、。"'”’％%＠@（）()｛｝{}「」：；:;/／￥0-9０-９A-zＡ-ｚ一-龠ぁ-んァ-ヶ]+?)】/g,
            "<span class='dot'>$1</span>"
        );
    return txtTmp;
}
</script>

<template>
    <Head title="Novels" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                小説一覧
            </h2>
        </template>
        <div class="bg-white py-2 px-2 w-full h-full sm:px-4 lg:px-6">
            <div class="showNovels w-full flex overflow-x-scroll">
                <div v-for="novel in novels" :key="novel.id" class="m-2">
                    <div
                        class="p-6 w-64 bg-white rounded-lg border border-gray-200 shadow-md"
                    >
                        <h5
                            class="truncate mb-2 text-xl sm:text-2xl font-bold tracking-tight text-gray-900"
                        >
                            {{ novel.title }}
                        </h5>
                        <p
                            v-html="showPreview(novel.body)"
                            class="truncate whitespace-pre-line break-all mb-3 text-sm sm:text-normal font-normal text-gray-700"
                            style="
                                display: -webkit-box;
                                -webkit-box-orient: vertical;
                                -webkit-line-clamp: 3;
                            "
                        ></p>
                        <a
                            :href="route('novelEdit', novel.id)"
                            class="inline-flex truncate items-center py-2 px-3 text-white bg-blue-500 hover:bg-blue-700 focus:bg-blue-900 font-medium rounded-lg text-sm"
                        >
                            Edit
                            <svg
                                aria-hidden="true"
                                class="ml-2 -mr-1 w-4 h-4"
                                fill="currentColor"
                                viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                ></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
