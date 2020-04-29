<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Question;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    return [
        'question_title' => $faker->sentence(4),
        'question_body' => $faker->paragraph(4),
        'user_id' => factory(\App\User::class)
    ];
});

$factory->afterCreating(Question::class, function ($question, Faker $faker) {
    $tags = $faker->words();
    foreach ($tags as $tag) {
        $tag = \App\Tag::firstOrCreate(['name' => $tag]);

        $question->tags()->attach($tag->id);
    }

});
