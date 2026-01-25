<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Test;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Schema;

class TestsSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Test::truncate();
        Question::truncate();
        Schema::enableForeignKeyConstraints();

        $testData = [
            'is_active' => true,
            'title' => [
                'kz' => 'Ясауи өмірі бойынша тест',
                'ru' => 'Тест по жизни Ясави',
                'en' => 'Test on Yasawi\'s life',
                'tr' => 'Yesevi\'nin hayatı üzerine test',
            ],
            'questions' => [
                [
                    'correct_answer' => '1093',
                    'question' => [
                        'kz' => 'Ахмет Ясауи қай жылы туылған?',
                        'ru' => 'В каком году родился Ахмет Ясави?',
                        'en' => 'In which year was Ahmed Yasawi born?',
                        'tr' => 'Ahmed Yesevi hangi yılda doğdu?',
                    ],
                    'options' => [
                        'kz' => ['1093', '1103', '1166'],
                        'ru' => ['1093', '1103', '1166'],
                        'en' => ['1093', '1103', '1166'],
                        'tr' => ['1093', '1103', '1166'],
                    ],
                ],
                [
                    'correct_answer' => 'Sairam',
                    'question' => [
                        'kz' => 'Ахмет Ясауи қай қалада туылған?',
                        'ru' => 'В каком городе родился Ахмет Ясави?',
                        'en' => 'In which city was Ahmed Yasawi born?',
                        'tr' => 'Ahmed Yesevi hangi şehirde doğdu?',
                    ],
                    'options' => [
                        'kz' => ['Sairam', 'Turkistan', 'Otrar'],
                        'ru' => ['Сайрам', 'Туркестан', 'Отрар'],
                        'en' => ['Sayram', 'Turkistan', 'Otrar'],
                        'tr' => ['Sayram', 'Türkistan', 'Otrar'],
                    ],
                ],
            ]
        ];

        $test = Test::create(['is_active' => $testData['is_active']]);
        foreach (['kz', 'ru', 'en', 'tr'] as $locale) {
            $test->setTranslation('title', $locale, $testData['title'][$locale]);
        }

        foreach ($testData['questions'] as $qData) {
            $question = Question::create([
                'test_id' => $test->id,
                'correct_answer' => $qData['correct_answer'],
            ]);

            foreach (['kz', 'ru', 'en', 'tr'] as $locale) {
                $question->setTranslation('question', $locale, $qData['question'][$locale]);
                $question->setTranslation('options', $locale, json_encode($qData['options'][$locale]));
            }
        }
    }
}
