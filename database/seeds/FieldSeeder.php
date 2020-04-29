<?php

use Illuminate\Database\Seeder;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fieldNames = ['Game', 'Web & IT', 'e-Sports', 'Anime & Illustration', 'AI & Robot', 'CG & Video'];
        $fieldImages = ['game.png', 'web_it.png', 'esports.png', 'anime_illustration.png', 'ai_robot.png', 'cg_video.png'];

        for ($x = 0; $x < count($fieldNames); $x++) {
            $fields[$x] = ['name' => $fieldNames[$x], 'image' => $fieldImages[$x]];
        }

        foreach ($fields as $field) {
            \App\Field::create([
                'name' => $field['name'],
                'search_index' => 'field',
                'field_image' => 'field_images/' . $field['image']
            ]);
        }

    }
}
