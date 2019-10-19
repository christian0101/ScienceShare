<?php

use App\Post;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 5; $i++) {
            $post = new Post;
            $post->user_id = App\User::pluck('id')->random();
            $post->title = "Title $i";
            $post->text = "Foo bar $i, bar foo";
            $post->save();
        }

        factory(App\Post::class, 20)->create();
    }
}
