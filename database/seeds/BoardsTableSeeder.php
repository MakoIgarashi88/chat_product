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
        $model->name = '自由';
        $model->detail = 'フリーダム！';
        $model->save();

        $model = new Board;
        $model->user_id = 2;
        $model->name = '掲示板です';
        $model->detail = 'おはようございます';
        $model->save();

        $model = new Board;
        $model->user_id = 3;
        $model->name = '雨';
        $model->detail = '飴';
        $model->save();

        $model = new Board;
        $model->user_id = 4;
        $model->name = '飴細工職人です';
        $model->detail = '同業者募集';
        $model->save();

        $model = new Board;
        $model->user_id = 5;
        $model->name = 'さようなら';
        $model->detail = 'こんにちは';
        $model->save();

        $model = new Board;
        $model->user_id = 6;
        $model->name = '万能キー';
        $model->detail = 'TOP OF （豆腐）リーダーオンユ';
        $model->save();

        $model = new Board;
        $model->user_id = 7;
        $model->name = 'カリスマミンホゥ';
        $model->detail = '力強くテミン';
        $model->save();

        $model = new Board;
        $model->user_id = 8;
        $model->name = 'I`ll be back!!!!! ';
        $model->detail = 'シュワです';
        $model->save();

        $model = new Board;
        $model->user_id = 9;
        $model->name = 'トゥインクル is';
        $model->detail = 'ジョンヒョン';
        $model->save();

    }
}
