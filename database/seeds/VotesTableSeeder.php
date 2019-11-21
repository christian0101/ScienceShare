<?php

use App\Vote;
use Illuminate\Database\Seeder;

class VotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // make vote objects
        factory(App\Vote::class, 200)->make()->each(function ($vote) {
            // add only unique votes
            Vote::firstOrCreate(
            [
              'user_id' => $vote->user_id,
              'post_id' => $vote->post_id
            ],
            [
              'user_id' => $vote->user_id,
              'post_id' => $vote->post_id,
              'type' => $vote->type
            ]);
        });
    }
}
