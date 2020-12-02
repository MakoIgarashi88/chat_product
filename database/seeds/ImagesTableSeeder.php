<?php

use Illuminate\Database\Seeder;
use App\Image;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new Image;
        $model->name = 'storage/images/1z2M3ouOdb74r93Q.png';
        $model->save();
                
        $model = new Image;
        $model->name = 'storage/images/yAyRulAQaz6f7DIV.png';
        $model->save();  
             
        $model = new Image;
        $model->name = 'storage/images/t99bXtwJWwe6FmHe.png';
        $model->save();     

        $model = new Image;
        $model->name = 'storage/images/QPZUNpPqoz4RPHY2.png';
        $model->save();      

        $model = new Image;
        $model->name = 'storage/images/AxjoQSN8CYhihwNc.png';
        $model->save();     

        $model = new Image;
        $model->name = 'storage/images/Z4Wm6pZfqcoD6Hu1.png';
        $model->save();

        $model = new Image;
        $model->name = 'storage/images/e4yocHpzM84s5Z4f.png';
        $model->save();

        $model = new Image;
        $model->name = 'storage/images/4y7OKZg4ANOxwO5p.png';
        $model->save();

    }
}
