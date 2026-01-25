<?php

namespace Database\Seeders;

use App\Models\Path;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Schema;

class PathsSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Path::truncate();
        Schema::enableForeignKeyConstraints();

        $paths = [
            [
                'coordinates' => [
                    ['lat' => 43.297756, 'lng' => 68.262434],
                    ['lat' => 43.297788, 'lng' => 68.267112],
                    ['lat' => 43.29638, 'lng' => 68.272305],
                    ['lat' => 43.296068, 'lng' => 68.276896],
                ],
                'title' => [
                    'kz' => 'Кесенеге жол',
                    'ru' => 'Путь к мавзолею',
                    'en' => 'Path to the Mausoleum',
                    'tr' => 'Mozoleye giden yol',
                ],
                'content' => [
                    'kz' => 'Бұл жол ежелгі қала арқылы өтеді.',
                    'ru' => 'Этот путь проходит через древний город.',
                    'en' => 'This path goes through the ancient city.',
                    'tr' => 'Bu yol antik şehirden geçer.',
                ],
            ],
            [
                'coordinates' => [
                    ['lat' => 43.300000, 'lng' => 68.270000],
                    ['lat' => 43.305000, 'lng' => 68.275000],
                ],
                'title' => [
                    'kz' => 'Қылует жерасты мешіті',
                    'ru' => 'Подземная мечеть Кылует',
                    'en' => 'Hilvet Underground Mosque',
                    'tr' => 'Hilvet Yeraltı Camii',
                ],
                'content' => [
                    'kz' => 'Ясауи өмірінің соңғы жылдарын өткізген жер.',
                    'ru' => 'Место, где Ясави провел последние годы жизни.',
                    'en' => 'The place where Yasawi spent the last years of his life.',
                    'tr' => 'Yesevi\'nin hayatının son yıllarını geçirdiği yer.',
                ],
            ],
        ];

        foreach ($paths as $data) {
            $path = Path::create([
                'coordinates' => $data['coordinates'],
            ]);

            foreach (['kz', 'ru', 'en', 'tr'] as $locale) {
                $path->setTranslation('title', $locale, $data['title'][$locale]);
                $path->setTranslation('content', $locale, $data['content'][$locale]);
            }
        }
    }
}
