<?php

use Illuminate\Database\Seeder;
use App\PrivateMessage;
use App\User;

class PrivateMessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $max_user_id = User::orderBy('id', 'desc')->first()->id;

        // ユーザー１は友達２～４とチャットしている
        for ($i = 2; $i <= 4; $i++) {
            $model = new PrivateMessage;
            $model->user_id = 1;
            $model->friend_id = $i;
            $model->body = 'おはよう';
            $model->save();
        }

        for ($i = 2; $i <= 4; $i++) {
            $model = new PrivateMessage;
            $model->user_id = $i;
            $model->friend_id = 1;
            $model->body = 'おはよう';
            $model->save();
        }
    }
}
