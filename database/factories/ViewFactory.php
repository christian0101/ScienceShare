<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\View;
use Faker\Generator as Faker;

$factory->define(View::class, function (Faker $faker) {
    return [
        'identifier' => $faker->ipv4(),
        'post_id' => App\Post::pluck('id')->random()
    ];
});
