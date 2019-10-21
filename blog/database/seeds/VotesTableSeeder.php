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
        //$total = SUM(vote);
        factory(App\Vote::class, 60)->make()->each(function ($vote) {
            Vote::firstOrCreate(
            [
              'user_id' => $vote->user_id,
              'post_id' => $vote->post_id],
            [
              'user_id' => $vote->user_id,
              'post_id' => $vote->post_id,
              'type' => $vote->type
            ]);
        });
    }
}
