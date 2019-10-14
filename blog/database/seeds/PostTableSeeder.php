<?php

use App\Post;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
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
            $post->author = "Foo $i";
            $post->text = "Foo bar $i, bar foo";
            $post->save();
        }

        factory(App\Post::class, 20)->create();
    }
}
