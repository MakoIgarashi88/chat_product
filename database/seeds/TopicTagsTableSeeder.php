<?php

use Illuminate\Database\Seeder;

use App\Topic;
use App\Tag;
use App\TopicTag;

class TopicTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $max_topic_id = Topic::orderBy('id', 'desc')->first()->id;
        $max_tag_id = Tag::orderBy('id', 'desc')->first()->id;

        for ($i = 1;$i <= $max_topic_id;$i++) {
            for ($j = 1;$j <= $max_tag_id;$j++) {
                $topic_tag = new TopicTag;
                $topic_tag->topic_id = $i;
                $topic_tag->tag_id = $j;
                $topic_tag->save();
            }
        }
    }
}
