<?php

use Illuminate\Database\Seeder;

class TestEntrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Question::class, 50)->create()->each(function ($question) {
            $question->answers()->createMany(factory(\App\Answer::class, 20)->make()->toArray());
        });

    }
}
