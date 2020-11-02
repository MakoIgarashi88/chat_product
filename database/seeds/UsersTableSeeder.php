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
        $model->birthday = Carbon::now()->toDateString();
        $model->email = '';
        $model->password = bcrypt('1234');
        $model->is_admin = true;
        $model->api_token = Str::random(60);
        $model->save();

        $model = new User;
        $model->name = 'mako';
        $model->birthday = Carbon::createFromDate('1998', '08', '26', 'Asia/Tokyo')->toDateString();
        $model->email = '';
        $model->password = bcrypt('1234');
        $model->is_admin = true;
        $model->api_token = Str::random(60);
        $model->save();

        $model = new User;
        $model->name = 'fuuga';
        $model->birthday = Carbon::createFromDate('1998', '08', '27', 'Asia/Tokyo')->toDateString();
        $model->email = '';
        $model->password = bcrypt('1234');
        $model->is_admin = true;
        $model->api_token = Str::random(60);
        $model->save();
    }
}
