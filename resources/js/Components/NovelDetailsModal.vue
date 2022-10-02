<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
import axios from "axios";

defineEmits(["close"]);
const props = defineProps({
    presentShowNovel: Object,
    user: Object,
    canEdit: Boolean,
});

const submit = (e) => {
    if (props.canEdit) {
        e.preventDefault(); // ブラウザの保存ショートカットキーを無効化
        axios
            .post(`/novels/${props.presentShowNovel.id}/update`, {
                title: props.presentShowNovel.title,
                body: props.presentShowNovel.body,
                author: props.presentShowNovel.author,
                is_done: props.presentShowNovel.is_done,
            })
            .then(function (response) {})
            .catch((error) => {
                console.log(error);
            });
    }
};

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
</script>

<style>
#modal {
    animation: SlideIn 0.5s;
}
@keyframes SlideIn {
    0% {
        transform: translateY(100%);
    }
    100% {
        transform: translateY(0);
    }
}

#modal-button {
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
</style>

<template>
    <div class="z-20 fixed top-0 left-0 w-full h-full bg-black/50">
        {{ saveMessage }}
        <form @submit.prevent="submit">
            <button
                id="modal-button"
                @click="$emit('close')"
                type="submit"
                class="text-white font-bold hover:bg-gray-100/80 hover:text-gray-800 rounded-lg text-sm sm:text-base p-2 absolute top-12 sm:top-[90px] right-0 inline-flex items-center"
            >
                閉じる X
            </button>
            <div
                id="modal"
                class="fixed bottom-0 z-30 w-full h-[calc(100vh-82px)] sm:h-[calc(100vh-130px)] p-4 overflow-y-auto bg-white"
            >
                <div
                    class="max-w-[90rem] lg:mx-auto sm:px-4 h-full grid grid-cols-3 grid-rows-1 gap-5"
                >
                    <div class="w-full h-full col-start-1 col-end-3">
                        <h5 class="text-xs sm:text-sm text-gray-400">
                            シリーズ
                        </h5>
                        <div
                            class="truncate mb-3 text-sm sm:text-base font-medium text-gray-800"
                        >
                            テストシリーズ
                        </div>

                        <h5 class="text-xs sm:text-sm text-gray-400">
                            タイトル
                        </h5>
                        <input
                            v-if="canEdit"
                            v-model="presentShowNovel.title"
                            @keydown.ctrl.s="submit"
                            class="truncate w-full sm:max-w-md mb-3 text-xl sm:text-2xl font-bold text-gray-800 border-solid border-2 border-zinc-400"
                        />
                        <p
                            v-else
                            class="truncate w-full sm:max-w-md mb-3 text-xl sm:text-2xl font-bold text-gray-800"
                        >
                            {{ presentShowNovel.title }}
                        </p>

                        <h5 class="text-xs sm:text-sm text-gray-400">
                            著者（{{ user.name }}）
                        </h5>
                        <div
                            class="truncate mb-3 text-sm sm:text-base font-medium text-gray-800"
                        >
                            <div class="w-full text-gray-800">
                                <input
                                    v-if="canEdit"
                                    @keydown.ctrl.s="submit"
                                    :placeholder="user.author"
                                    v-model="presentShowNovel.author"
                                    class="truncate w-1/2 sm:max-w-xs border-solid border-2 border-zinc-400"
                                />
                                <input
                                    v-else
                                    :disabled="!canEdit"
                                    :placeholder="user.author"
                                    v-model="presentShowNovel.author"
                                    class="truncate w-1/2 sm:max-w-xs bg-white"
                                />
                            </div>
                        </div>

                        <h5 class="text-xs sm:text-sm text-gray-400">本文</h5>
                        <p
                            v-html="showPreview(presentShowNovel.body)"
                            class="truncate whitespace-pre-line break-all mb-3 text-sm sm:text-normal font-normal text-gray-800"
                            style="
                                display: -webkit-box;
                                -webkit-box-orient: vertical;
                                -webkit-line-clamp: 10;
                            "
                        ></p>

                        <h5 class="absolute bottom-10 text-xs text-gray-400">
                            {{ presentShowNovel.updated_at }}
                        </h5>
                    </div>

                    <menu
                        class="w-full h-full text-center text-xs sm:text-base col-start-3 col-end-4 grid grid-cols-1 grid-rows-5 gap-5"
                    >
                        <div
                            class="border-2 border-zinc-200 rounded-xl py-2 sm:py-5 row-start-1 row-end-5"
                        >
                            <a
                                v-if="presentShowNovel.id && !canEdit"
                                :href="route('novelEdit', presentShowNovel.id)"
                                for="edit"
                            >
                                <li
                                    v-if="!canEdit"
                                    class="py-2 my-2 w-3/5 mx-auto bg-gray-100 hover:bg-gray-200 active:bg-gray-300 rounded-lg text-gray-600 font-medium"
                                >
                                    執筆
                                </li>
                            </a>
                            <li
                                v-else
                                class="py-2 my-2 w-3/5 mx-auto bg-gray-200 rounded-lg text-gray-600 font-medium"
                            >
                                執筆
                            </li>

                            <li
                                class="py-2 my-2 w-3/5 mx-auto bg-gray-100 hover:bg-gray-200 active:bg-gray-300 rounded-lg text-gray-600 font-medium"
                            >
                                複製
                            </li>
                            <li
                                class="py-2 my-2 w-3/5 mx-auto bg-red-300 hover:bg-red-400 active:bg-red-500 rounded-lg text-white font-medium"
                            >
                                削除
                            </li>
                        </div>
                        <div class="row-start-5 row-end-6">
                            {{ presentShowNovel.is_done }}
                            <select
                                :disabled="!canEdit"
                                v-model="presentShowNovel.is_done"
                                class="text-xs sm:text-base border-2 border-zinc-200 rounded-xl"
                            >
                                <option value="0">執筆中</option>
                                <option value="1">執筆完了</option>
                            </select>
                        </div>
                    </menu>
                </div>
            </div>
        </form>
    </div>
</template>
