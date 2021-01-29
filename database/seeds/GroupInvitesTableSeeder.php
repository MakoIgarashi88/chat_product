<?php

use Illuminate\Database\Seeder;

use App\GroupInvite;

class GroupInvitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new GroupInvite;
        $model->user_id = 2;
        $model->friend_id = 1;
        $model->group_id = 2;
        $model->save();

        $model = new GroupInvite;
        $model->user_id = 2;
        $model->friend_id = 1;
        $model->group_id = 3;
        $model->save();

        $model = new GroupInvite;
        $model->user_id = 3;
        $model->friend_id = 1;
        $model->group_id = 4;
        $model->save();

        // $model = new GroupInvite;
        // $model->user_id = 5;
        // $model->friend_id = 2;
        // $model->group_id = 3;
        // $model->save();

    }
}
