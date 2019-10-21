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
            Tag::firstOrCreate(['name' => $tag->name], ['name' => $tag->name]);
        });
    }
}
