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
            [
                'slug' => 'spiritual-mentors',
                'order' => 3,
                'title' => [
                    'kz' => 'Рухани ұстаздары',
                    'ru' => 'Духовные наставники',
                    'en' => 'Spiritual Mentors',
                    'tr' => 'Manevi Rehberleri',
                ],
                'content' => [
                    'kz' => 'Аңыздарда Арслан баба Ясауидің рухани ұстазы ретінде аталады...',
                    'ru' => 'В легендах Арслан Баба упоминается как духовный наставник Ясави...',
                    'en' => 'Legends mention Arslan Baba as Yasawi’s spiritual mentor...',
                    'tr' => 'Efsanelerde Arslan Baba, Yesevi’nin manevi rehberi olarak anılır...',
                ],
            ],
            [
                'slug' => 'sufi-path',
                'order' => 4,
                'title' => [
                    'kz' => 'Сопылық жолы',
                    'ru' => 'Суфийский путь',
                    'en' => 'Sufi Path',
                    'tr' => 'Tasavvuf Yolu',
                ],
                'content' => [
                    'kz' => 'Ясауи сопылық ілімді түркі дүниесіне түсінікті тілде жеткізді...',
                    'ru' => 'Ясави донёс суфийское учение на понятном тюркскому миру языке...',
                    'en' => 'Yasawi conveyed Sufi teachings in a language accessible to the Turkic world...',
                    'tr' => 'Yesevi, tasavvuf öğretilerini Türk dünyasına anlaşılır bir dilde aktardı...',
                ],
            ],
            [
                'slug' => 'hikmet-legacy',
                'order' => 5,
                'title' => [
                    'kz' => 'Хикмет мұрасы',
                    'ru' => 'Наследие хикметов',
                    'en' => 'Legacy of Hikmet',
                    'tr' => 'Hikmet Mirası',
                ],
                'content' => [
                    'kz' => '«Диуани Хикмет» арқылы рухани-этикалық құндылықтар тарады...',
                    'ru' => 'Через «Диван-и Хикмет» распространялись духовно-нравственные ценности...',
                    'en' => 'Through the “Divan-i Hikmet,” spiritual and ethical values were shared...',
                    'tr' => '“Divan-ı Hikmet” aracılığıyla manevi ve ahlaki değerler yayıldı...',
                ],
            ],
            [
                'slug' => 'turkistan-period',
                'order' => 6,
                'title' => [
                    'kz' => 'Түркістандағы кезеңі',
                    'ru' => 'Период в Туркестане',
                    'en' => 'Period in Turkistan',
                    'tr' => 'Türkistan Dönemi',
                ],
                'content' => [
                    'kz' => 'Ясауи өмірінің маңызды бөлігі Түркістанда өтті...',
                    'ru' => 'Важная часть жизни Ясави прошла в Туркестане...',
                    'en' => 'A significant part of Yasawi’s life was spent in Turkistan...',
                    'tr' => 'Yesevi’nin hayatının önemli bir bölümü Türkistan’da geçti...',
                ],
            ],
            [
                'slug' => 'mausoleum',
                'order' => 7,
                'title' => [
                    'kz' => 'Кесене тарихы',
                    'ru' => 'История мавзолея',
                    'en' => 'Mausoleum History',
                    'tr' => 'Türbe Tarihi',
                ],
                'content' => [
                    'kz' => 'Кесене Әмір Темір дәуірінде салынған тарихи ескерткіш...',
                    'ru' => 'Мавзолей — исторический памятник, построенный в эпоху Тимура...',
                    'en' => 'The mausoleum is a historical monument built in the era of Timur...',
                    'tr' => 'Türbe, Timur döneminde inşa edilen tarihi bir anıttır...',
                ],
            ],
            [
                'slug' => 'legacy-and-influence',
                'order' => 8,
                'title' => [
                    'kz' => 'Мұрасы мен ықпалы',
                    'ru' => 'Наследие и влияние',
                    'en' => 'Legacy and Influence',
                    'tr' => 'Mirası ve Etkisi',
                ],
                'content' => [
                    'kz' => 'Ясауи ілімі Орталық Азиядағы рухани өмірге зор ықпал етті...',
                    'ru' => 'Учение Ясави оказало большое влияние на духовную жизнь Центральной Азии...',
                    'en' => 'Yasawi’s teachings had a major impact on Central Asia’s spiritual life...',
                    'tr' => 'Yesevi’nin öğretisi Orta Asya’nın manevi hayatını derinden etkiledi...',
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
