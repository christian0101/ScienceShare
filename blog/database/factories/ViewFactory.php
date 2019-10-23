<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\View;
use Faker\Generator as Faker;

$factory->define(View::class, function (Faker $faker) {
    return [
        'identifier' => rand(0, 255).'.'.rand(0, 255).'.'.rand(0, 255).'.'.rand(0, 255),
        'post_id' => App\Post::pluck('id')->random()
    ];
});
