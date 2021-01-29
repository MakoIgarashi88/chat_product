<?php

use Illuminate\Database\Seeder;
use App\Topic;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {       
        $topic = new Topic;
        $topic->name = '東方神起';
        $topic->detail = '～東方神起好きな人集まれ～';
        $topic->tags = json_encode(['ユノ','チャンミン','歌手']);
        $topic->image_id = 10;
        $topic->save();

        $topic = new Topic;
        $topic->name = '天童覚';
        $topic->detail = '覚君推しのためのトピックです(^^*)';
        $topic->tags = json_encode(['バレー','ハイキュー']);
        $topic->image_id = 11;
        $topic->save();

        $topic = new Topic;
        $topic->name = '赤葦京治';
        $topic->detail = '赤葦推しのためのトピックです(^^*)';
        $topic->tags = json_encode(['ハイキュー!!','漫画','あかーし']);
        $topic->image_id = 12;
        $topic->save();

        $topic = new Topic;
        $topic->name = '灰羽リエーフ';
        $topic->detail = 'リエーフ推しのためのトピックです(^^*)';
        $topic->tags = json_encode(['音駒高校排球部','バレーボール','ハイキュー']);
        $topic->image_id = 13;
        $topic->save();
    
        $topic = new Topic;
        $topic->name = '東海オンエア';
        $topic->detail = 'てつや/しばゆー/りょう/としみつ/夢丸/虫眼鏡';
        $topic->tags = json_encode(['ユーチューバー','youtuber','岡崎']);
        $topic->image_id = 14;
        $topic->save();

        $topic = new Topic;
        $topic->name = 'WANIMA';
        $topic->detail = 'ワニマ/バンド/歌手';
        $topic->tags = json_encode(['熊本','バンドマン','わにま']);
        $topic->image_id = 15;
        $topic->save();

        $topic = new Topic;
        $topic->name = '炎炎ノ消防隊';
        $topic->detail = '祝！！第二期！！';
        $topic->tags = json_encode(['講談社','アニメ']);
        $topic->image_id = 16;
        $topic->save();

        $topic = new Topic;
        $topic->name = 'ハイキュー！';
        $topic->detail = 'ハイキュー好きな人話しましょう！';
        $topic->tags = json_encode(['漫画','アニメ','バレーボール']);
        $topic->image_id = 17;
        $topic->save();

        $topic = new Topic;
        $topic->name = '漫画好きのためのトピック';
        $topic->detail = 'みんなで好きな漫画について語りたいです！ジャンル不問！出版社不問！';
        $topic->tags = json_encode(['まんが','マンガ']);
        $topic->image_id = 18;
        $topic->save();

        $topic = new Topic;
        $topic->name = 'The Warking Dead';
        $topic->detail = 'ウォーキングデッド/海外ドラマ';
        $topic->tags = json_encode(['TWD','アメリカ']);
        $topic->image_id = 19;
        $topic->save();

        $topic = new Topic;
        $topic->name = 'THE MENTALIST';
        $topic->detail = 'サイモンベイカー/パトリックジェーン';
        $topic->tags = json_encode(['海外ドラマ','スーパー！ドラマTV','FOX']);
        $topic->image_id = 20;
        $topic->save();

        $topic = new Topic;
        $topic->name = 'スタジオジブリ';
        $topic->detail = '千と千尋の神隠し/ハウルの動く城/風の谷のナウシカ/もののけ姫/などなど、たくさんのジブリ作品のお話をしましょう！';
        $topic->tags = json_encode(['ジブリ','宮崎駿']);
        $topic->image_id = 21;
        $topic->save();
    }
}
