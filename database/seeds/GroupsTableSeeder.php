<?php

use Illuminate\Database\Seeder;

use App\Group;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = new Group;
        $group->name = 'サンプルグループ';
        $group->save();
    }
}
