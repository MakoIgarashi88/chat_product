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
        $model = new UserFriend;
        $model->user_id = 1;
        $model->friend_id = 2;
        $model->save();

        $model = new UserFriend;
        $model->user_id = 1;
        $model->friend_id = 3;
        $model->save();

        $model = new UserFriend;
        $model->user_id = 1;
        $model->friend_id = 4;
        $model->save();

        $model = new UserFriend;
        $model->user_id = 2;
        $model->friend_id = 1;
        $model->save();

        $model = new UserFriend;
        $model->user_id = 3;
        $model->friend_id = 1;
        $model->save();

        $model = new UserFriend;
        $model->user_id = 4;
        $model->friend_id = 9;
        $model->save();

        $model = new UserFriend;
        $model->user_id = 5;
        $model->friend_id = 7;
        $model->save();

        $model = new UserFriend;
        $model->user_id = 6;
        $model->friend_id = 8;
        $model->save();

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
