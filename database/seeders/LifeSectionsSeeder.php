<?php

namespace Database\Seeders;

use App\Models\LifeSection;
use Illuminate\Database\Seeder;

class LifeSectionsSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [
            [
                'slug' => 'birth-and-childhood',
                'order' => 1,
                'title' => [
                    'kz' => 'Тууы және балалық шағы',
                    'ru' => 'Рождение и детство',
                    'en' => 'Birth and Childhood',
                    'tr' => 'Doğumu ve Çocukluğu',
                ],
                'content' => [
                    'kz' => 'Ахмет Ясауи 1093 жылы Сайрам қаласында дүниеге келген...',
                    'ru' => 'Ахмет Ясави родился в 1093 году в городе Сайрам...',
                    'en' => 'Ahmed Yasawi was born in 1093 in the city of Sayram...',
                    'tr' => 'Ahmed Yesevi 1093 yılında Sayram şehrinde doğdu...',
                ],
            ],
            [
                'slug' => 'education',
                'order' => 2,
                'title' => [
                    'kz' => 'Білім алуы',
                    'ru' => 'Образование',
                    'en' => 'Education',
                    'tr' => 'Eğitimi',
                ],
                'content' => [
                    'kz' => 'Алғашқы білімін әкесі Ибраһим атадан алған...',
                    'ru' => 'Первые знания получил от своего отца Ибрагима...',
                    'en' => 'He received his first knowledge from his father Ibrahim...',
                    'tr' => 'İlk eğitimini babası İbrahim\'den aldı...',
                ],
            ],
        ];

        foreach ($sections as $data) {
            $section = LifeSection::updateOrCreate(
                ['slug' => $data['slug']],
                [
                    'order' => $data['order'],
                    'image' => null, // Placeholder
                ]
            );

            foreach (['kz', 'ru', 'en', 'tr'] as $locale) {
                $section->setTranslation('title', $locale, $data['title'][$locale]);
                $section->setTranslation('content', $locale, $data['content'][$locale]);
            }
        }
    }
}
