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
        $group->name = '夜久さん推し';
        $group->detail = 'トピックでは話せないような事も気兼ねなく話そう！';
        $group->image_id = 22;
        $group->save();
        
        $group = new Group;
        $group->name = 'ONE PIECE!!';
        $group->detail = 'トピックに人が多かったので、よく話してた人たち集めました';
        $group->image_id = 23;
        $group->save();

        $group = new Group;
        $group->name = '2年3組';
        $group->detail = 'リア友だけ';
        $group->image_id = 24;
        $group->save();

        $group = new Group;
        $group->name = 'バスケ部';
        $group->detail = '漫画好きトピックのバスケ部集めました';
        $group->image_id = 25;
        $group->save();
    }
}
