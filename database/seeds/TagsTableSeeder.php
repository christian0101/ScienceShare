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
        // make tag objects
        factory(App\Tag::class, 200)->make()->each(function ($tag) {
            // create tag only if it does not already exist
            $new_tag = Tag::firstOrNew(
              ['name' => $tag->name],
              ['name' => $tag->name]
            );

            // save tag and attach to a random post
            if (!$new_tag->exists) {
              $new_tag->save();
              $new_tag->posts()
                ->attach(App\Post::all()
                ->random(rand(2, 6))->pluck('id')->toArray());
            }
        });
    }
}
