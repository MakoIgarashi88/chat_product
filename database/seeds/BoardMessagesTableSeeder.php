<?php

use Illuminate\Database\Seeder;
use App\BoardMessage;
use App\User;

class BoardMessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $max_user_id = User::orderBy('id', 'desc')->first()->id;

        // ユーザー１の掲示板には友達２～４とがコメントする
        for ($i = 2; $i <= 4; $i++) {
            $model = new BoardMessage;
            $model->board_id = 1;
            $model->user_id = $i;
            $model->body = 'おはよう';
            $model->save();
        }
    }
}
