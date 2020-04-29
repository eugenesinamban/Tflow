<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'details' => $faker->sentence(4),
        'url' => $faker->url,
        'course' => $faker->word,
        'year' => $faker->numberBetween(1,4),
        'about_myself' => $faker->sentence(6),
        'profile_image' => $faker->image(),
    ];
});
