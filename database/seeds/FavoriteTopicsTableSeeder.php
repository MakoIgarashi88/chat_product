<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Topic;
use App\FavoriteTopic;

class FavoriteTopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $max_user_id = User::orderBy('id', 'desc')->first()->id;
        $max_topic_id = Topic::orderBy('id', 'desc')->first()->id;

        for ($i = 1; $i <= $max_user_id; $i++) {
            for ($j = 1;$j <= $max_topic_id;$j++) {
                if ($i != $j) {
                    $favorite_topic = new FavoriteTopic;
                    $favorite_topic->user_id = $i;
                    $favorite_topic->topic_id = $j;
                    $favorite_topic->save();
                }
            }
        }
    }
}
