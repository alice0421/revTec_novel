<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { ref, computed } from "vue";
import axios from "axios";

const novelTitle = ref("吾輩は猫である");
const novelBody = ref(
    "【例】\n吾輩は猫である。名前はまだ無い。どこで生れたか頓と見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。吾輩はここで始めて人間というものを見た。しかもあとで聞くとそれは書生という人間中で一番獰悪な種族であったそうだ。この書生というのは時々我々を捕えて煮て食うという話である。しかしその当時は何という考もなかったから別段恐しいとも思わなかった。ただ彼の掌に載せられてスーと持ち上げられた時何だかフワフワした感じがあったばかりである。掌の上で少し落ち付いて書生の顔を見たのがいわゆる人間というものの見始であろう。この時妙なものだと思った感じが今でも残っている。第一毛を以て装飾されべきはずの顔がつるつるしてまるで薬缶だ。その後猫にも大分逢ったがこんな片輪には一度も出会わした事がない。のみならず顔の真中が余りに突起している。そうしてその穴の中から時々ぷうぷうと烟を吹く。どうも咽せぽくて実に弱った。これが人間の飲む烟草というものである事は漸くこの頃知った。"
);

function novelSave() {
    console.log("click");
    axios
        .post(route("novelSave"), {
            title: "小説タイトル",
            body: "小説本文",
        })
        .then((res) => {
            console.log(res.data);
            //console.log(novelBody);
        })
        .catch((err) => {
            console.log(err);
        });
}
</script>

<template>
    <Head title="Editor" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <menu class="h-full grid grid-cols-7 grid-rows-1 gap-2">
                <div class="col-start-1 col-end-4">
                    <a
                        href="#"
                        class="truncate text-left font-semibold text-xl text-gray-800 hover:underline hover:text-blue-600"
                    >
                        {{ novelTitle }}
                    </a>
                </div>
                <div
                    class="col-start-4 h-full text-center grid grid-cols-2 grid-rows-1 gap-2"
                >
                    <button
                        id="bracket"
                        class="col-start-1 border-2 rounded-lg text-xs sm:text-base hover:bg-gray-100 active:bg-gray-200"
                    >
                        「」
                    </button>
                    <button
                        class="col-start-2 border-2 rounded-lg text-xs sm:text-base hover:bg-gray-100 active:bg-gray-200"
                    >
                        …
                    </button>
                </div>
                <div
                    class="col-start-5 h-full text-center grid grid-cols-2 grid-rows-1 gap-2"
                >
                    <button
                        class="col-start-1 border-2 rounded-lg truncate text-xs sm:text-base hover:bg-gray-100 active:bg-gray-200"
                    >
                        ―
                    </button>
                    <button
                        class="col-start-2 border-2 rounded-lg truncate text-xs sm:text-base hover:bg-gray-100 active:bg-gray-200"
                    >
                        ␣
                    </button>
                </div>
                <div
                    class="col-start-6 h-full text-center grid grid-cols-2 grid-rows-1 gap-2"
                >
                    <button
                        class="col-start-1 border-2 rounded-lg truncate text-xs sm:text-base hover:bg-gray-100 active:bg-gray-200"
                    >
                        ルビ
                    </button>
                    <button
                        class="col-start-2 border-2 rounded-lg truncate text-xs sm:text-base hover:bg-gray-100 active:bg-gray-200"
                    >
                        傍点
                    </button>
                </div>
                <div
                    class="col-start-7 h-full text-center grid grid-cols-2 grid-rows-1 gap-2"
                >
                    <button
                        @click="novelSave"
                        class="col-start-1 border-2 rounded-lg truncate text-xs sm:text-base hover:bg-gray-100 active:bg-gray-200"
                    >
                        <img
                            :src="'/images/icon_save.png'"
                            alt="保存"
                            class="object-contain h-full w-full"
                        />
                    </button>
                    <button
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
                        v-model="novelBody"
                        class="resize-none w-full h-full border-none"
                    ></textarea>
                </div>
                <div
                    class="row-span-6 col-start-5 col-span-3 border-solid border-2 border-zinc-400 p-3"
                >
                    <p
                        class="whitespace-pre-line break-all overflow-x-auto w-full h-full"
                        style="
                            writing-mode: vertical-rl;
                            text-orientation: mixed;
                        "
                    >
                        {{ novelBody }}
                    </p>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
