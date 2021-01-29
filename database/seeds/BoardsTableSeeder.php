<?php

use Illuminate\Database\Seeder;
use App\Board;

class BoardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new Board;
        $model->user_id = 1;
        $model->name = '掲示板タイトル';
        $model->detail = '掲示板詳細';
        $model->save();

        $model = new Board;
        $model->user_id = 2;
        $model->name = '御用の方はコチラまで';
        $model->detail = '鬼滅の刃が好きです（単行本派）';
        $model->save();

        $model = new Board;
        $model->user_id = 3;
        $model->name = '用のある人はここに';
        $model->detail = '呪いに詳しいので、困りごとがあれば遠慮なく話してみてください';
        $model->save();

        $model = new Board;
        $model->user_id = 4;
        $model->name = 'ヒーロー志望';
        $model->detail = 'ヒーローが大好きです！気軽に声をかけてください！！';
        $model->save();

        $model = new Board;
        $model->user_id = 5;
        $model->name = 'Plus Ultra!!';
        $model->detail = '気兼ねなく話そう！';
        $model->save();

        $model = new Board;
        $model->user_id = 6;
        $model->name = 'こんにちは';
        $model->detail = '鬼を見たらご連絡ください';
        $model->save();

        $model = new Board;
        $model->user_id = 7;
        $model->name = '爆殺王';
        $model->detail = 'しゃべんな';
        $model->save();

        $model = new Board;
        $model->user_id = 8;
        $model->name = '牛乳パン';
        $model->detail = 'バレーに興味ある人は話しましょう';
        $model->save();

        $model = new Board;
        $model->user_id = 9;
        $model->name = 'ゲームの話がしたいです';
        $model->detail = 'MHX/MHW:IB/PUBG/FFX';
        $model->save();

    }
}
