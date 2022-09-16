<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { ref } from "vue";

defineProps({
    novels: Array,
});

const swipe = ref(0); // カルーセル用のtailwind css
let carouselPos = 0; // カルーセル位置（0: 一番左の時）

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

// 幅100％から引いている。
// ボタンの推した回数で制限⇒実際の長さ/現在の幅で回数が分かるはず！
const carousel = (dir) => {
    if (carouselPos <= 0) {
        if (dir == "right") {
            swipe.value = swipe.value + 100;
            carouselPos++;
        }
    } else if (0 < carouselPos && carouselPos < 5) {
        if (dir == "right") {
            swipe.value = swipe.value + 100;
            carouselPos++;
        } else {
            swipe.value = swipe.value - 100;
            carouselPos--;
        }
    } else {
        if (dir == "left") {
            swipe.value = swipe.value - 100;
            carouselPos--;
        }
    }
};
</script>

<style>
/*小説一覧でのスクロールバーを無くす*/
.showNovels::-webkit-scrollbar {
    display: none;
}

/* 傍点 */
span.dot {
    -webkit-text-emphasis: filled circle black;
    text-emphasis: filled circle black;
}
</style>

<template>
    <Head title="Novels" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                小説一覧
            </h2>
        </template>

        <div class="bg-white py-2 px-4 w-full h-full sm:px-16">
            <!-- 一番上の小説一覧 -->
            <div
                class="relative max-w-[90rem] overflow-x-hidden lg:mx-auto px-10"
            >
                <button
                    type="button"
                    @click="carousel('left')"
                    class="absolute left-2 bottom-24 z-10 w-10 h-10 border-2 rounded-full bg-gray-50 hover:bg-gray-100 active:bg-gray-200"
                >
                    <img
                        :src="'/images/icon_left.png'"
                        alt="左"
                        class="object-contain h-full w-full"
                    />
                </button>
                {{ swipe }}
                {{ carouselPos }}
                <div
                    class="showNovels flex"
                    :style="`transform: translateX(-${swipe}%)`"
                >
                    <div v-for="novel in novels" :key="novel.id" class="m-2">
                        <div
                            class="relative p-6 w-56 h-52 bg-white rounded-lg border border-gray-200 shadow-md"
                        >
                            <h5
                                class="truncate mb-2 text-2xl font-bold text-black"
                            >
                                {{ novel.title }}
                            </h5>
                            <p
                                v-html="showPreview(novel.body)"
                                class="truncate whitespace-pre-line break-all mb-3 text-sm sm:text-normal font-normal text-gray-400"
                                style="
                                    display: -webkit-box;
                                    -webkit-box-orient: vertical;
                                    -webkit-line-clamp: 3;
                                "
                            ></p>
                            <a
                                :href="route('novelEdit', novel.id)"
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
                            </a>
                        </div>
                    </div>
                </div>
                <button
                    type="button"
                    @click="carousel('right')"
                    class="absolute right-2 bottom-24 z-10 w-10 h-10 border-2 rounded-full bg-gray-50 hover:bg-gray-100 active:bg-gray-200"
                >
                    <img
                        :src="'/images/icon_right.png'"
                        alt="左"
                        class="object-contain h-full w-full"
                    />
                </button>
            </div>

            <!-- 二番目以降は以下に書くこと -->
        </div>
    </BreezeAuthenticatedLayout>
</template>
