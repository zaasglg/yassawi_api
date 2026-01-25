<?php

namespace Database\Seeders;

use App\Models\Study;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Schema;

class StudiesSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Study::truncate();
        Schema::enableForeignKeyConstraints();

        $studies = [
            [
                'type' => 'video',
                'title' => [
                    'kz' => 'Ясауи ілімі туралы дәріс',
                    'ru' => 'Лекция об учении Ясави',
                    'en' => 'Lecture on Yasawi\'s teachings',
                    'tr' => 'Yesevi öğretisi üzerine ders',
                ],
                'content' => [
                    'kz' => 'Бұл бейнероликте Ясауидің негізгі идеялары түсіндіріледі.',
                    'ru' => 'В этом видео объясняются основные идеи Ясави.',
                    'en' => 'This video explains the main ideas of Yasawi.',
                    'tr' => 'Bu videoda Yesevi\'nin temel fikirleri açıklanmaktadır.',
                ],
            ],
            [
                'type' => 'article',
                'title' => [
                    'kz' => 'Сопылық тарихы',
                    'ru' => 'История суфизма',
                    'en' => 'History of Sufism',
                    'tr' => 'Tasavvuf Tarihi',
                ],
                'content' => [
                    'kz' => 'Сопылықтың қалай пайда болғаны туралы мақала.',
                    'ru' => 'Статья о том, как возник суфизм.',
                    'en' => 'Article on how Sufism emerged.',
                    'tr' => 'Tasavvufun nasıl ortaya çıktığına dair makale.',
                ],
            ],
        ];

        foreach ($studies as $data) {
            $study = Study::create([
                'type' => $data['type'],
            ]);

            foreach (['kz', 'ru', 'en', 'tr'] as $locale) {
                $study->setTranslation('title', $locale, $data['title'][$locale]);
                $study->setTranslation('content', $locale, $data['content'][$locale]);
            }
        }
    }
}
