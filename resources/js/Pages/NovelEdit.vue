<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
import NovelDetailsModal from "@/Components/NovelDetailsModal.vue";
import { ref, computed } from "vue";

const props = defineProps({
    novel: Object,
    user: Object,
});

// 保存機能
const submit = (e) => {
    e.preventDefault(); // ブラウザの保存ショートカットキーを無効化
    axios
        .post(`/novels/${props.novel.id}/update`, {
            title: props.novel.title,
            body: props.novel.body,
            author: props.novel.author,
            is_done: props.novel.is_done,
        })
        .then(function (response) {})
        .catch((error) => {
            console.log(error);
        });
};

// 記号挿入機能
function insertSymbol(symbol) {
    document.execCommand("insertText", false, symbol);
}

// プレビュー機能（アウトライン・ルビ・傍点の変換（正規表現））
const showPreview = computed(() => {
    let txt = props.novel.body;
    txt = txt
        .replace(
            /[\|｜][＃|#]([　,.ー―-！？!?～~・、。"'”’％%＠@（）()｛｝{}「」：；:;/／￥0-9０-９A-zＡ-ｚ一-龠ぁ-んァ-ヶ]+?)[＃|#]/g,
            "<span class='font-semibold text-xl'>$1</span>"
        )
        .replace(
            /[\|｜]([　,.ー―-！？!?～~・、。"'”’％%＠@（）()｛｝{}「」：；:;/／￥0-9０-９A-zＡ-ｚ一-龠ぁ-んァ-ヶ]+)《([　,.ー―-！？!?～~・、。"'”’％%＠@（）()｛｝{}「」：；:;/／￥0-9０-９A-zＡ-ｚ一-龠ぁ-んァ-ヶ]+?)》/g,
            "<ruby>$1<rt>$2</rt></ruby>"
        )
        .replace(
            /[\|｜]【([　,.ー―-！？!?～~・、。"'”’％%＠@（）()｛｝{}「」：；:;/／￥0-9０-９A-zＡ-ｚ一-龠ぁ-んァ-ヶ]+?)】/g,
            "<span class='dot'>$1</span>"
        );
    return txt;
});

// 小説詳細のモーダル表示制御
const showNovelDetails = ref(false);
const openNovelDetails = (novel) => {
    showNovelDetails.value = true;
};
const closeNovelDetails = () => {
    showNovelDetails.value = false;
};
</script>

<style>
/* 傍点 */
span.dot {
    -webkit-text-emphasis: filled circle black;
    text-emphasis: filled circle black;
}
</style>

<!-- BreezeAuthenticatedLayout内にログアウトのsubmitがあるため、form分割 -->
<template>
    <Head title="NovelEdit" />
    <BreezeAuthenticatedLayout>
        <template #header>
            <menu class="h-full grid grid-cols-7 grid-rows-1 gap-2">
                <div class="col-start-1 col-end-3">
                    <label for="titleEdit" class="w-full">
                        <button
                            id="titleEdit"
                            type="button"
                            @click="openNovelDetails(novel)"
                            class="truncate w-full h-full px-1 text-left font-semibold text-sm sm:text-xl text-blue-500 hover:underline"
                        >
                            <img
                                :src="'/images/icon_edit.png'"
                                alt="タイトル編集"
                                class="inline object-contain h-full"
                            />{{ novel.title }}
                        </button>
                    </label>
                </div>
                <div
                    class="col-start-3 h-full text-center grid grid-cols-2 grid-rows-1 gap-2"
                >
                    <button
                        type="button"
                        @click="insertSymbol('｜＃＃')"
                        class="col-start-2 border-2 rounded-lg truncate text-xs sm:text-base hover:bg-gray-100 active:bg-gray-200"
                    >
                        見出し
                    </button>
                </div>
                <div
                    class="col-start-4 h-full text-center grid grid-cols-2 grid-rows-1 gap-2"
                >
                    <button
                        type="button"
                        @click="insertSymbol('「」')"
                        class="col-start-1 border-2 rounded-lg truncate text-xs sm:text-base hover:bg-gray-100 active:bg-gray-200"
                    >
                        「」
                    </button>
                    <button
                        type="button"
                        @click="insertSymbol('......')"
                        class="col-start-2 border-2 rounded-lg truncate text-xs sm:text-base hover:bg-gray-100 active:bg-gray-200"
                    >
                        …
                    </button>
                </div>
                <div
                    class="col-start-5 h-full text-center grid grid-cols-2 grid-rows-1 gap-2"
                >
                    <button
                        type="button"
                        @click="insertSymbol('――')"
                        class="col-start-1 border-2 rounded-lg truncate text-xs sm:text-base hover:bg-gray-100 active:bg-gray-200"
                    >
                        ―
                    </button>
                    <button
                        type="button"
                        @click="insertSymbol('　')"
                        class="col-start-2 border-2 rounded-lg truncate text-xs sm:text-base hover:bg-gray-100 active:bg-gray-200"
                    >
                        ␣
                    </button>
                </div>
                <div
                    class="col-start-6 h-full text-center grid grid-cols-2 grid-rows-1 gap-2"
                >
                    <button
                        type="button"
                        @click="insertSymbol('｜《》')"
                        class="col-start-1 border-2 rounded-lg truncate text-xs sm:text-base hover:bg-gray-100 active:bg-gray-200"
                    >
                        ルビ
                    </button>
                    <button
                        type="button"
                        @click="insertSymbol('｜【】')"
                        class="col-start-2 border-2 rounded-lg truncate text-xs sm:text-base hover:bg-gray-100 active:bg-gray-200"
                    >
                        傍点
                    </button>
                </div>
                <div
                    class="col-start-7 h-full text-center grid grid-cols-2 grid-rows-1 gap-2"
                >
                    <button
                        type="submit"
                        class="col-start-1 border-2 rounded-lg truncate text-xs sm:text-base hover:bg-gray-100 active:bg-gray-200"
                    >
                        <img
                            :src="'/images/icon_save.png'"
                            alt="保存"
                            class="object-contain h-full w-full"
                        />
                    </button>
                    <button
                        type="button"
                        class="col-start-2 border-2 rounded-lg truncate text-xs sm:text-base hover:bg-gray-100 active:bg-gray-200"
                    >
                        <img
                            :src="'/images/icon_output.png'"
                            alt="出力"
                            class="object-contain h-full w-full"
                        />
                    </button>
                </div>
            </menu>
        </template>

        <form @submit.prevent="submit" class="h-full">
            <div class="bg-white py-2 px-2 h-full sm:px-4 lg:px-6">
                <div class="grid grid-rows-6 grid-cols-7 gap-2 h-full">
                    <div
                        class="row-start-1 row-end-4 col-start-1 border-solid border-2 border-zinc-400 p-3"
                    >
                        アウトラインツリー
                    </div>
                    <div
                        class="row-start-4 row-end-7 col-start-1 border-solid border-2 border-zinc-400 p-3"
                    >
                        メモ一覧(実装予定)
                    </div>
                    <div
                        class="row-span-6 col-start-2 col-span-3 border-solid border-2 border-zinc-400"
                    >
                        <textarea
                            @keydown.ctrl.s="submit"
                            v-model="novel.body"
                            class="resize-none w-full h-full border-none"
                        ></textarea>
                    </div>
                    <div
                        class="row-span-6 col-start-5 col-span-3 border-solid border-2 border-zinc-400 p-3"
                    >
                        <p
                            v-html="showPreview"
                            class="whitespace-pre-line break-all overflow-x-auto w-full h-full"
                            style="
                                writing-mode: vertical-rl;
                                text-orientation: mixed;
                            "
                        ></p>
                    </div>
                </div>
            </div>
        </form>

        <NovelDetailsModal
            v-show="showNovelDetails"
            @close="closeNovelDetails"
            :presentShowNovel="novel"
            :user="user"
        />
    </BreezeAuthenticatedLayout>
</template>
