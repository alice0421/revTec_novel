<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
import NovelDetailsModal from "@/Components/NovelDetailsModal.vue";
import { ref } from "vue";

const props = defineProps({
    novels: Array,
    category: String,
    user: Object,
});

// プレビュー機能（アウトライン・ルビ・傍点の変換（正規表現））
function showPreview(txt) {
    let txtTmp = txt;
    if (txtTmp) {
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
    }
    return txtTmp;
}

// 小説詳細のモーダル表示制御
const showNovelDetails = ref(false);
const presentShowNovel = ref("");
const openNovelDetails = (novel) => {
    showNovelDetails.value = true;
    presentShowNovel.value = novel;
};
const closeNovelDetails = () => {
    showNovelDetails.value = false;
};
</script>

<template>
    <Head title="NovelsMore" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ category }}
            </h2>
        </template>
        <div class="bg-white py-2 px-4 w-full h-full sm:px-16">
            <div class="flex flex-wrap max-w-[90rem] mx-auto">
                <div v-for="novel in novels" :key="novel.id" class="m-2">
                    <article
                        class="relative p-6 w-56 h-52 bg-white rounded-lg border border-gray-200 shadow-md"
                    >
                        <div
                            class="truncate mb-2 text-2xl font-bold text-gray-800"
                        >
                            {{ novel.title }}
                        </div>
                        <p
                            v-html="showPreview(novel.body)"
                            class="truncate whitespace-pre-line break-all mb-3 text-sm sm:text-normal font-normal text-gray-400"
                            style="
                                display: -webkit-box;
                                -webkit-box-orient: vertical;
                                -webkit-line-clamp: 3;
                            "
                        ></p>
                        <button
                            type="button"
                            @click="openNovelDetails(novel)"
                            class="absolute bottom-6 left-6 inline-flex truncate items-center py-2 px-3 text-white bg-blue-500 hover:bg-blue-700 active:bg-blue-900 font-medium rounded-lg text-sm"
                        >
                            詳細
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
                        </button>
                    </article>
                </div>
            </div>
        </div>

        <NovelDetailsModal
            v-show="showNovelDetails"
            @close="closeNovelDetails"
            :presentShowNovel="presentShowNovel"
            :user="user"
            :canEdit="false"
        />
    </BreezeAuthenticatedLayout>
</template>
