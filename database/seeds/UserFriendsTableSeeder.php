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
        $max_user_id = User::orderBy('id', 'desc')->first()->id;

        for ($i = 1;$i <= $max_user_id;$i++) {
            for ($j = 1;$j <= $max_user_id;$j++) {
                if ($i != $j) {
                    $user_friend = new UserFriend;
                    $user_friend->user_id = $i;
                    $user_friend->friend_id = $j;
                    $user_friend->save();
                }
            }
        }
    }
}
