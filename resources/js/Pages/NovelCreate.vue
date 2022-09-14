<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, computed } from "vue";

const user = usePage().props.value.auth.user.id; // user_idを取得

const form = useForm({
    title: "吾輩は猫である",
    body: "｜＃「吾輩は猫である」冒頭＃\n\n｜吾輩《わがはい》は｜【猫】である。名前はまだ無い。どこで生れたか｜頓《とん》と見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。吾輩はここで始めて人間というものを見た。しかもあとで聞くとそれは書生という人間中で一番｜獰悪《どうあく》な種族であったそうだ。この書生というのは時々我々を｜捕《つかま》えて煮て食うという話である。しかしその当時は何という｜考《かんがえ》もなかったから別段恐しいとも思わなかった。ただ彼の｜掌《てのひら》に載せられてスーと持ち上げられた時何だかフワフワした感じがあったばかりである。掌の上で少し落ち付いて書生の顔を見たのがいわゆる人間というものの見始であろう。この時妙なものだと思った感じが今でも残っている。第一毛を以て装飾されべきはずの顔がつるつるしてまるで｜薬缶《やかん》だ。その後猫にも大分｜逢《あ》ったがこんな片輪には一度も｜出会《でく》わした事がない。のみならず顔の真中が余りに突起している。そうしてその穴の中から時々ぷうぷうと｜烟《けむり》を吹く。どうも｜咽《む》せぽくて実に弱った。これが人間の飲む｜烟草《タバコ》というものである事は｜漸《ようや》くこの｜頃《ごろ》知った。",
    user_id: user,
    output_setting_template_id: 1,
});

// 保存機能
const submit = (e) => {
    e.preventDefault(); // ブラウザの保存ショートカットキーを無効化
    form.post(route("novelStore"), {});
};

// 記号挿入機能
function insertSymbol(symbol) {
    document.execCommand("insertText", false, symbol);
}

// プレビュー機能（アウトライン・ルビ・傍点の変換（正規表現））
const showPreview = computed(() => {
    let txt = form.body;
    txt = txt
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
    return txt;
});
</script>

<!-- BreezeAuthenticatedLayout内にログアウトのsubmitがあるため、form分割 -->
<template>
    <Head title="NovelCreate" />
    <BreezeAuthenticatedLayout>
        <template #header>
            <form @submit.prevent="submit" class="h-full">
                <menu class="h-full grid grid-cols-7 grid-rows-1 gap-2">
                    <div class="col-start-1 col-end-3">
                        <input
                            type="text"
                            @keydown.ctrl.s="submit"
                            v-model="form.title"
                            class="w-full h-full text-left font-semibold text-base sm:text-xl text-gray-800 border-solid border-2 border-zinc-400 py-3 px-1"
                        />
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
            </form>
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
                            v-model="form.body"
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
    </BreezeAuthenticatedLayout>
</template>
