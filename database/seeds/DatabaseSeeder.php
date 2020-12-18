<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(UserFriendsTableSeeder::class);
        $this->call(GroupUsersTableSeeder::class);
        $this->call(ImagesTableSeeder::class);
        $this->call(TopicsTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(BoardsTableSeeder::class);
        $this->call(FavoriteTopicsTableSeeder::class);
        $this->call(TopicTagsTableSeeder::class);
        $this->call(GroupInvitesTableSeeder::class);
    }
}
