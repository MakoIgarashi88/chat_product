<?php

use Illuminate\Database\Seeder;

use App\UserFriend;
use App\User;

class UserFriendsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ユーザー1は2~4番と友だち
        for ($id = 2; $id <= 9; $id++) {
            $model = new UserFriend;
            $model->user_id = 1;
            $model->friend_id = $id;
            $model->save();
        }

        // 2~9番はお互いに友だち
        for ($i = 2; $i <= 9; $i++) {
            for ($j = 1;$j <= 9;$j++) {
                if ($i != $j) {
                    $model = new UserFriend;
                    $model->user_id = $i;
                    $model->friend_id = $j;
                    $model->save();
                }
            }
        }
        
        // $max_user_id = User::orderBy('id', 'desc')->first()->id;

        // for ($i = 1;$i <= $max_user_id;$i++) {
        //     for ($j = 1;$j <= $max_user_id;$j++) {
        //         if ($i != $j) {
        //             $user_friend = new UserFriend;
        //             $user_friend->user_id = $i;
        //             $user_friend->friend_id = $j;
        //             $user_friend->save();
        //         }
        //     }
        // }
    }
}
