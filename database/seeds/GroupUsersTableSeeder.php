<?php

use Illuminate\Database\Seeder;
use App\GroupUser;
use App\User;
use App\Group;

class GroupUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_ids = User::all()->pluck('id');
        $group_ids = Group::all()->pluck('id');

        foreach ($group_ids as $group_id) {
            foreach ($user_ids as $user_id) {
                $group_user = new GroupUser;
                $group_user->user_id = $user_id;
                $group_user->group_id = $group_id;
                $group_user->save();
            }
        }
    }
}
