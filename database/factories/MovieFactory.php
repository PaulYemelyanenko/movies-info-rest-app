<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Movie;
use Faker\Generator as Faker;

$factory->define(Movie::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'year' => $faker->year($max = 'now'),
        'format' => $faker->randomElement($assetName = ['VHS', 'DVD', 'Blu-Ray']),
        'actor_fullname' => $faker->name,
    ];
});
