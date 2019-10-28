<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Vote;
use Faker\Generator as Faker;

$factory->define(Vote::class, function (Faker $faker) {
    $types = array(1, -1);
    return [
        'user_id' => App\User::pluck('id')->random(),
        'post_id' => App\Post::pluck('id')->random(),
        'type' => $types[array_rand($types)]
    ];
});
