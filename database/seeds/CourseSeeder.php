<?php

use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 22 courses

        $courses = [
            1 => [
                'スーパーゲームクリエイター専攻',
                'ゲームプログラマー専攻',
                'ゲーム企画・シナリオ専攻',
                'ゲームキャラクターデザイン専攻',
                'ゲームCGデザイン専攻'
            ],
            2 => [
                'スーパーITエンジニア専攻',
                'プログラマー専攻',
                'Webクリエーター専攻'
            ],
            3 => [
                'eSportsプロマネージメント専攻',
                'eSports・プロゲーマー専攻'
            ],
            4 => [
                'コミックイラスト専攻',
                '総合アニメーション専攻',
            ],
            5 => [
                'ロボット&IoT専攻',
                'ロボット専攻',
                'スーパーホワイトハッカー専攻',
                '宇宙テクノロジー専攻',
                'スーパーAIクリエーター専攻',
                'ロボット・AIエンジニア専攻',
                'スーパーメディカルIT専攻'
            ],
            6 => [
                'スーパーデジタルメディア専攻',
                'スーパーCGクリエーター専攻',
                'CG映像クリエーター専攻'
            ]
        ];

        foreach ($courses as $id => $course) {

            foreach ($course as $c) {
                \App\Course::create([
                    'name' => $c,
                    'field_id' => $id,
                    'search_index' => 'course'
                ]);
            }

        }
    }
}
