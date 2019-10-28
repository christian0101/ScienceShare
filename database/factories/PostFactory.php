<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => App\User::pluck('id')->random(),
        'title' => $faker->realText(rand(50, 100)).'..',
        'content' => $faker->realText(rand(600, 900))
    ];
});
