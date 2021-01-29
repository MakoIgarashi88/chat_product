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
        $model->name = 'storage/images/02.jpg';
        $model->save();
                
        $model = new Image;
        $model->name = 'storage/images/03.jpg';
        $model->save();  
             
        $model = new Image;
        $model->name = 'storage/images/04.jpg';
        $model->save();     

        $model = new Image;
        $model->name = 'storage/images/05.jpg';
        $model->save();      

        $model = new Image;
        $model->name = 'storage/images/06.png';
        $model->save();     

        $model = new Image;
        $model->name = 'storage/images/07.jpeg';
        $model->save();

        $model = new Image;
        $model->name = 'storage/images/08.png';
        $model->save();

        $model = new Image;
        $model->name = 'storage/images/09.jpeg';
        $model->save();

        $model = new Image;
        $model->name = 'storage/images/10.jpg';
        $model->save();

        $model = new Image;
        $model->name = 'storage/images/11.png';
        $model->save();

        $model = new Image;
        $model->name = 'storage/images/12.jpg';
        $model->save();

        $model = new Image;
        $model->name = 'storage/images/13.jpg';
        $model->save();

        $model = new Image;
        $model->name = 'storage/images/14.png';
        $model->save();

        $model = new Image;
        $model->name = 'storage/images/15.jpg';
        $model->save();

        $model = new Image;
        $model->name = 'storage/images/16.jpg';
        $model->save();

        $model = new Image;
        $model->name = 'storage/images/17.jpg';
        $model->save();

        $model = new Image;
        $model->name = 'storage/images/18.png';
        $model->save();

        $model = new Image;
        $model->name = 'storage/images/19.jpg';
        $model->save();

        $model = new Image;
        $model->name = 'storage/images/20.jpg';
        $model->save();

        $model = new Image;
        $model->name = 'storage/images/21.png';
        $model->save();

        $model = new Image;
        $model->name = 'storage/images/22.jpg';
        $model->save();

        $model = new Image;
        $model->name = 'storage/images/23.jpg';
        $model->save();

        $model = new Image;
        $model->name = 'storage/images/24.png';
        $model->save();

        $model = new Image;
        $model->name = 'storage/images/25.png';
        $model->save();


    }
}
