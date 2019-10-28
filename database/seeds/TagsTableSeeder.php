<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Tag::class, 30)->make()->each(function ($tag) {
            $new_tag = Tag::firstOrNew(
              ['name' => $tag->name],
              ['name' => $tag->name]
            );

            if (!$new_tag->exists) {
              $new_tag->save();
              $new_tag->posts()->attach(App\Post::pluck('id')->random());
            }
        });
    }
}
