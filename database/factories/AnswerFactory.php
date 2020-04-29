<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Answer;
use Faker\Generator as Faker;

$factory->define(Answer::class, function (Faker $faker) {
    return [
        'answer' => $faker->sentence(7),
        'user_id' => factory(\App\User::class),
        'question_id' => factory(\App\Question::class)
    ];
});
