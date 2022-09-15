<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Novel;

class NovelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Novel::create([
            'title' => 'Title01',
            'body' => 'Body01',
            'user_id' => 1,
            'output_setting_template_id' => 1,
        ]);
        Novel::create([
            'title' => 'Title02',
            'body' => 'Body02',
            'user_id' => 2,
            'output_setting_template_id' => 1,
        ]);
        Novel::create([
            'title' => 'テストテストテストテストテストテストテストテストテストテストテストテストテストテスト',
            'body' => 'テストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテスト',
            'user_id' => 1,
            'output_setting_template_id' => 1,
        ]);
        Novel::create([
            'title' => 'Title04',
            'body' => 'Body04',
            'user_id' => 2,
            'output_setting_template_id' => 1,
        ]);
        Novel::create([
            'title' => 'eryyyyyyyyytfewsdo098u6t7hbjuygtsw4azexdfyg',
            'body' => 'oimvopanyp9wqmoapi,vq0u4mtvq0mtvu9ut4k,q90tvu0tuv^qtqvqu05[q50k,9vtul,p[43vk0qyvkq[,ptvlvqt8jm90v3k,4vl[u9,qtvmk30934qv,leq[v8chmb-y',
            'user_id' => 1,
            'output_setting_template_id' => 1,
        ]);
        Novel::create([
            'title' => '雪国',
            'body' => '｜＃「雪国」冒頭＃

国境の長いトンネルを抜けると雪国であった。夜の底が白くなった。信号所に汽車が止まった。 向側の座席から娘が立って来て、島村の前のガラス窓を落した。雪の冷気が流れこんだ。娘は窓いっぱいに乗り出して、遠くへ呼ぶように、「駅長さあん、駅長さあん」 明りをさげてゆっくり雪を踏んで来た男は、襟巻で鼻の上まで包み、耳に帽子の毛皮を垂れていた。 もうそんな寒さかと島村は外を眺めると、鉄道の官舎らしいバラックが山裾に寒々と散らばっているだけで、雪の色はそこまで行かぬうちに闇に呑まれていた。「駅長さん、私です、御機嫌よろしゅうございます」 「ああ、葉子さんじゃないか。お帰りかい。また寒くなったよ」「弟が今度こちらに勤めさせていただいておりますのですってね。お世話さまですわ」',
            'user_id' => 2,
            'output_setting_template_id' => 1,
        ]);
        Novel::create([
            'title' => '吾輩は猫である',
            'body' => '｜＃「吾輩は猫である」冒頭＃

｜吾輩《わがはい》は｜【猫】である。名前はまだ無い。どこで生れたか｜頓《とん》と見当がつかぬ。何でも薄暗いじめじめした所でニャーニャー泣いていた事だけは記憶している。吾輩はここで始めて人間というものを見た。しかもあとで聞くとそれは書生という人間中で一番｜獰悪《どうあく》な種族であったそうだ。この書生というのは時々我々を｜捕《つかま》えて煮て食うという話である。しかしその当時は何という｜考《かんがえ》もなかったから別段恐しいとも思わなかった。ただ彼の｜掌《てのひら》に載せられてスーと持ち上げられた時何だかフワフワした感じがあったばかりである。掌の上で少し落ち付いて書生の顔を見たのがいわゆる人間というものの見始であろう。この時妙なものだと思った感じが今でも残っている。第一毛を以て装飾されべきはずの顔がつるつるしてまるで｜薬缶《やかん》だ。その後猫にも大分｜逢《あ》ったがこんな片輪には一度も｜出会《でく》わした事がない。のみならず顔の真中が余りに突起している。そうしてその穴の中から時々ぷうぷうと｜烟《けむり》を吹く。どうも｜咽《む》せぽくて実に弱った。これが人間の飲む｜烟草《タバコ》というものである事は｜漸《ようや》くこの｜頃《ごろ》知った。',
            'user_id' => 1,
            'output_setting_template_id' => 1,
        ]);
    }
}
