<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Topic;
use App\TopicMessage;

class TopicMessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $max_topic_id = Topic::orderBy('id', 'desc')->first()->id;
        $max_user_id = User::orderBy('id', 'desc')->first()->id;


        // ユーザー６がすべてのトピックにコメント
        for ($i = 1; $i <= $max_topic_id; $i++) {
            $model = new TopicMessage;
            $model->topic_id = $i;
            $model->user_id = 6;
            $model->body = 'こんにちは';
            $model->save();
        }

        // ユーザー７がすべてのトピックにコメント
        for ($i = 1; $i <= $max_topic_id; $i++) {
            $model = new TopicMessage;
            $model->topic_id = $i;
            $model->user_id = 7;
            $model->body = 'お久しぶりです';
            $model->save();
        }

        // ユーザー８がすべてのトピックにコメント
        for ($i = 1; $i <= $max_topic_id; $i++) {
            $model = new TopicMessage;
            $model->topic_id = $i;
            $model->user_id = 8;
            $model->body = 'こんばんは';
            $model->save();
        }
    }
}
