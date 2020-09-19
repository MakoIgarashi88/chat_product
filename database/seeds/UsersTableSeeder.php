<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
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
        $model->email = '';
        $model->password = bcrypt('1234');
        $model->is_admin = true;
        $model->api_token = Str::random(60);
        $model->save();
    }
}
