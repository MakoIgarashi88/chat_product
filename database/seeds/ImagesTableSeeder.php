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
        $model->name = 'storage/images/01.png';
        $model->save();

        $model = new Image;
        $model->name = 'storage/images/02.png';
        $model->save();
                
        $model = new Image;
        $model->name = 'storage/images/03.png';
        $model->save();  
             
        $model = new Image;
        $model->name = 'storage/images/04.png';
        $model->save();     

        $model = new Image;
        $model->name = 'storage/images/05.png';
        $model->save();      

        $model = new Image;
        $model->name = 'storage/images/06.png';
        $model->save();     

        $model = new Image;
        $model->name = 'storage/images/07.png';
        $model->save();

        $model = new Image;
        $model->name = 'storage/images/08.png';
        $model->save();

        $model = new Image;
        $model->name = 'storage/images/09.png';
        $model->save();

    }
}
