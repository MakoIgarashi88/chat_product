<?php

use Illuminate\Database\Seeder;
use App\GroupMessage;
use App\User;
use App\Group;

class GroupMessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $max_user_id = User::orderBy('id', 'desc')->first()->id;
        $max_group_id = Group::orderBy('id', 'desc')->first()->id;

        //グループ１の会話（全員参加）
        for ($i = 1; $i <= $max_user_id; $i++) {
            $model = new GroupMessage;
            $model->user_id = $i;
            $model->group_id = 1;
            $model->body = 'こんにちは';
            $model->save();
        }

        //グループ２～４の会話（２・３のみ参加）
        for ($i = 2; $i <= $max_group_id; $i++) {
            for ($j = 2; $j <= 3; $j++) {
                $model = new GroupMessage;
                $model->user_id = $j;
                $model->group_id = $i;
                $model->body = 'こんにちは';
                $model->save();
            }
        }
    }
}
