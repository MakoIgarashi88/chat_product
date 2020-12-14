<?php

use Illuminate\Database\Seeder;

use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $model = new Tag;
        $model->name = '漫画';
        $model->save();
        
        $model = new Tag;
        $model->name = 'アニメ';
        $model->save();
        
        $model = new Tag;
        $model->name = 'アイドル';
        $model->save();
        
        $model = new Tag;
        $model->name = '歌手';
        $model->save();
        
        $model = new Tag;
        $model->name = 'ゲーム';
        $model->save();
        
        $model = new Tag;
        $model->name = 'オタク';
        $model->save();
    }
}
