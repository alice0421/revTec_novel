<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { ref, ouMounted, onMounted } from "vue";

const props = defineProps({
    novels: Array,
});

const swipe = ref(0); // カルーセル用のtailwind css
const carouselWidth = ref(0); // 現在のカルーセルの幅
const rest = ref(0);
const novelLength = 240 * props.novels.length; // 小説一覧の長さ（240はカード1枚当たりの幅(margin含む)）

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

// カルーセルの幅をid="carousel"の要素幅に合わせて計算
const resizeObserver = new ResizeObserver((entries) => {
    const carouselId = document.getElementById("carousel");
    carouselWidth.value = carouselId.clientWidth - 80; // 要素幅からpx-10(40px)*2を引く

    // 画面幅（carouselWidth）変更によるrestの再計算
    rest.value = novelLength - carouselWidth.value - swipe.value;

    // 画面幅小で一番最後の小説が見えている⇒画面幅大の時に最後の小説が画面幅の右端に来るように調整
    if (novelLength - swipe.value < carouselWidth.value) {
        swipe.value = novelLength - carouselWidth.value;
    }
});
onMounted(() => {
    // id="carousel"が生まれるのを待ってから実行
    // id="carousel"の要素幅を監視
    resizeObserver.observe(document.querySelector("#carousel"));
});

// ボタン押下時のカルーセルの挙動制御
const carouselButton = (dir) => {
    // swipe変更によるrestの再計算
    rest.value = novelLength - carouselWidth.value - swipe.value;

    if (swipe.value < carouselWidth.value) {
        if (dir == "right") {
            if (rest.value < carouselWidth.value) {
                swipe.value = swipe.value + rest.value;
            } else {
                swipe.value = swipe.value + carouselWidth.value;
            }
        } else {
            // 最後の余りを強制的に最初の小説に持ってくる
            swipe.value = 0;
        }
    } else if (
        carouselWidth.value <= swipe.value &&
        swipe.value < novelLength - carouselWidth.value
    ) {
        if (dir == "right" && rest.value < carouselWidth.value) {
            swipe.value = swipe.value + rest.value;
        } else {
            if (dir == "right") {
                swipe.value = swipe.value + carouselWidth.value;
            } else {
                swipe.value = swipe.value - carouselWidth.value;
            }
        }
    } else {
        if (dir == "left") {
            swipe.value = swipe.value - carouselWidth.value;
        }
    }
};
</script>

<style>
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
            swipe: {{ swipe }}, carouselWidth: {{ carouselWidth }}, novelLength:
            {{ 240 * novels.length }}, rest:
            {{ 240 * novels.length - carouselWidth - swipe }}
            <h2 class="text-lg sm:text-xl font-bold text-gray-800">
                最近編集した小説
            </h2>
            <div
                id="carousel"
                class="relative max-w-[90rem] overflow-x-hidden lg:mx-auto px-10"
            >
                <button
                    type="button"
                    @click="carouselButton('left')"
                    class="absolute left-2 bottom-24 z-10 w-10 h-10 border-2 rounded-full bg-gray-50 active:bg-gray-200 opacity-30 hover:opacity-80"
                >
                    <img
                        :src="'/images/icon_left.png'"
                        alt="左"
                        class="object-contain h-full w-full"
                    />
                </button>
                <div
                    class="flex"
                    :style="`transform: translateX(-${swipe}px); transition: all 500ms 0s ease-in-out;`"
                >
                    <div v-for="novel in novels" :key="novel.id" class="m-2">
                        <article
                            class="relative p-6 w-56 h-52 bg-white rounded-lg border border-gray-200 shadow-md"
                        >
                            <h5
                                class="truncate mb-2 text-2xl font-bold text-gray-800"
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
                        </article>
                    </div>
                </div>
                <button
                    type="button"
                    @click="carouselButton('right')"
                    class="absolute right-2 bottom-24 z-10 w-10 h-10 border-2 rounded-full bg-gray-50 active:bg-gray-200 opacity-30 hover:opacity-80"
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
