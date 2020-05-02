<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            FieldSeeder::class,
            CourseSeeder::class,
//            TestEntrySeeder::class
//            AdminSeeder::class
        ]);

//        \App\User::create([
//            'name' => 'test',
//            'email' => 'test@test.com',
//            'username' => 'test',
//            'email_verified_at' => now(),
//            'password' => Hash::make('testtest'),
//            'course_id' => 7,
//            'field_id' => 2,
//            'year' => 2
//        ]);

    }
}
