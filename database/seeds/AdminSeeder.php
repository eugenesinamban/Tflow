<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $course = rand(1, 22);

        \App\User::create([
            'name' => 'Eugene Sinamban',
            'email' => 'eugene.sinamban@gmail.com',
            'email_verified_at' => now(),
            'username' => 'codejunkie21',
            'password' => Hash::make('fuminalove'),
            'course_id' => 7,
            'field_id' => 2,
            'year' => 2
        ]);
    }
}
