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
        $max_user_id = User::orderBy('id', 'desc')->first()->id;
        $max_group_id = Group::orderBy('id', 'desc')->first()->id;

        // グループ１には全員が参加している
        for ($i = 1; $i <= $max_user_id; $i++) {
            $model = new GroupUser;
            $model->user_id = $i;
            $model->group_id = 1;
            $model->save();
        }

        // ユーザー２は全てのグループに所属している
        for ($i = 2; $i <= $max_group_id; $i++) {
            for ($j = 2; $j <= 3; $j++) {
                $model = new GroupUser;
                $model->user_id = $j;
                $model->group_id = $i;
                $model->save();
            }
        }

        
        // $user_ids = User::all()->pluck('id');
        // $group_ids = Group::all()->pluck('id');

        // foreach ($group_ids as $group_id) {
        //     foreach ($user_ids as $user_id) {
        //         $group_user = new GroupUser;
        //         $group_user->user_id = $user_id;
        //         $group_user->group_id = $group_id;
        //         $group_user->save();
        //     }
        // }
    }
}
