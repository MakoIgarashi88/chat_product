<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new User;
        $model->name = 'admin';
        $model->nickname = 'あどちゃん';
        $model->email = '';
        $model->image_id = 1;
        $model->password = bcrypt('1234');
        $model->is_admin = true;
        $model->api_token = Str::random(60);
        $model->save();

        $model = new User;
        $model->name = 'mako';
        $model->nickname = 'まこ';
        $model->image_id = 2;
        $model->email = '';
        $model->password = bcrypt('1234');
        $model->is_admin = true;
        $model->api_token = Str::random(60);
        $model->save();

        $model = new User;
        $model->name = 'fuuga';
        $model->nickname = 'ふうが';
        $model->image_id = 3;
        $model->email = '';
        $model->password = bcrypt('1234');
        $model->is_admin = true;
        $model->api_token = Str::random(60);
        $model->save();

        $model = new User;
        $model->name = 'changmin';
        $model->nickname = 'ちゃんみん';
        $model->image_id = 4;
        $model->email = '';
        $model->password = bcrypt('1234');
        $model->is_admin = true;
        $model->api_token = Str::random(60);
        $model->save();

        $model = new User;
        $model->name = '爆豪勝己';
        $model->nickname = 'かっちゃん';
        $model->image_id = 5;
        $model->email = '';
        $model->password = bcrypt('1234');
        $model->is_admin = true;
        $model->api_token = Str::random(60);
        $model->save();

        $model = new User;
        $model->name = '胡蝶しのぶ';
        $model->nickname = 'しのぶさん';
        $model->image_id = 6;
        $model->email = '';
        $model->password = bcrypt('1234');
        $model->is_admin = true;
        $model->api_token = Str::random(60);
        $model->save();

        $model = new User;
        $model->name = '忍';
        $model->nickname = 'キスショット・アセロラ・オリオン・ハートアンダーブレード';
        $model->image_id = 7;
        $model->email = '';
        $model->password = bcrypt('1234');
        $model->is_admin = true;
        $model->api_token = Str::random(60);
        $model->save();

        $model = new User;
        $model->name = '碇シンジ';
        $model->nickname = '逃げちゃだめだ';
        $model->image_id = 8;
        $model->email = '';
        $model->password = bcrypt('1234');
        $model->is_admin = true;
        $model->api_token = Str::random(60);
        $model->save();

        $model = new User;
        $model->name = 'yunho';
        $model->nickname = 'ゆの';
        $model->image_id = 9;
        $model->email = '';
        $model->password = bcrypt('1234');
        $model->is_admin = true;
        $model->api_token = Str::random(60);
        $model->save();
    }
}
