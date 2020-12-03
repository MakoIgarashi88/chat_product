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
        $group->name = 'アニメ';
        $group->detail = 'アニメ大好き';
        $group->image_id = 6;
        $group->save();
        
        $group = new Group;
        $group->name = '韓国組';
        $group->detail = '韓国～';
        $group->image_id = 4;
        $group->save();

        $group = new Group;
        $group->name = '東海オンエア';
        $group->detail = 'めでる';
        $group->image_id = 1;
        $group->save();

        $group = new Group;
        $group->name = '少女漫画';
        $group->detail = 'だいすき';
        $group->image_id = 5;
        $group->save();
    }
}
