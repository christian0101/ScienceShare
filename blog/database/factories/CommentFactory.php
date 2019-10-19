<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
      'user_id' => App\User::pluck('id')->random(),
      'post_id' => App\Post::pluck('id')->random(),
      'text' => $faker->realText(rand(100, 300))
    ];
});
