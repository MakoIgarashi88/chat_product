<?php

use Illuminate\Database\Seeder;
use App\Topic;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new Topic;
        $model->name = '暇人';
        $model->detail = '暇すぎちょっとだけはなそ';
        $model->save();

        $model = new Topic;
        $model->name = 'しのぶさんが好き';
        $model->detail = 'しのぶさんのためだけのトピック';
        $model->save();

        $model = new Topic;
        $model->name = 'JK会';
        $model->detail = '参加条件：JK（女子高校生）であること！';
        $model->save();

        $model = new Topic;
        $model->name = 'バスケが好き';
        $model->detail = 'サークル感覚ではなく本気でバスケ好きな人はなそー！';
        $model->save();

        $model = new Topic;
        $model->name = 'のんびり';
        $model->detail = '疲れた主婦の井戸端会議';
        $model->save();
                
    }
}
