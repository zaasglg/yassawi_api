<?php

namespace Database\Seeders;

use App\Models\Work;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Schema;

class WorksSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Work::truncate();
        Schema::enableForeignKeyConstraints();

        $works = [
            [
                'title' => [
                    'kz' => 'Диуани Хикмет',
                    'ru' => 'Дивани Хикмет',
                    'en' => 'Divan-i Hikmet',
                    'tr' => 'Divan-ı Hikmet',
                ],
                'short_description' => [
                    'kz' => 'Қожа Ахмет Ясауидің басты шығармасы.',
                    'ru' => 'Главное произведение Ходжи Ахмета Ясави.',
                    'en' => 'The main work of Khoja Ahmed Yasawi.',
                    'tr' => 'Hoca Ahmed Yesevi\'nin ana eseri.',
                ],
                'main_content' => [
                    'kz' => 'Бұл кітапта ислам құндылықтары жырланған...',
                    'ru' => 'В этой книге воспеваются исламские ценности...',
                    'en' => 'This book extols Islamic values...',
                    'tr' => 'Bu kitapta İslami değerler övülmektedir...',
                ],
                'spiritual_value' => [
                    'kz' => 'Түркі халықтарының рухани дамуына зор үлес қосты.',
                    'ru' => 'Внес огромный вклад в духовное развитие тюркских народов.',
                    'en' => 'Made a huge contribution to the spiritual development of the Turkic peoples.',
                    'tr' => 'Türk halklarının manevi gelişimine büyük katkı sağladı.',
                ],
            ],
            [
                'title' => [
                    'kz' => 'Мират-уль Қулуб',
                    'ru' => 'Мират-уль Кулуб',
                    'en' => 'Mirat-ul Qulub',
                    'tr' => 'Mirat-ül Kulub',
                ],
                'short_description' => [
                    'kz' => 'Жүректердің айнасы.',
                    'ru' => 'Зеркало сердец.',
                    'en' => 'Mirror of Hearts.',
                    'tr' => 'Kalplerin Aynası.',
                ],
                'main_content' => [
                    'kz' => 'Сопылық жолдың әдептері туралы...',
                    'ru' => 'Об этикете суфийского пути...',
                    'en' => 'About the etiquette of the Sufi path...',
                    'tr' => 'Tasavvuf yolunun edebi hakkında...',
                ],
                'spiritual_value' => [
                    'kz' => 'Адамгершілікке тәрбиелейді.',
                    'ru' => 'Воспитывает нравственность.',
                    'en' => 'Educates morality.',
                    'tr' => 'Ahlakı eğitir.',
                ],
            ],
        ];

        foreach ($works as $data) {
            $work = Work::create();

            foreach (['kz', 'ru', 'en', 'tr'] as $locale) {
                $work->setTranslation('title', $locale, $data['title'][$locale]);
                $work->setTranslation('short_description', $locale, $data['short_description'][$locale]);
                $work->setTranslation('main_content', $locale, $data['main_content'][$locale]);
                $work->setTranslation('spiritual_value', $locale, $data['spiritual_value'][$locale]);
            }
        }
    }
}
