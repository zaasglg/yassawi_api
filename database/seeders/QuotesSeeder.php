<?php

namespace Database\Seeders;

use App\Models\Quote;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Schema;

class QuotesSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Quote::truncate();
        Schema::enableForeignKeyConstraints();

        $quotes = [
            [
                'kz' => 'Алланың дидарына ғашық болып, түнімен ұйықтамай жыла.',
                'ru' => 'Влюбившись в лик Аллаха, плачь ночами напролет.',
                'en' => 'Fall in love with the face of Allah and cry through the night.',
                'tr' => 'Allah\'ın cemaline aşık ol ve gece boyunca ağla.',
            ],
            [
                'kz' => 'Кімде-кім Алланы таныса, ол өзін таниды.',
                'ru' => 'Кто познал Аллаха, тот познал себя.',
                'en' => 'He who knows Allah knows himself.',
                'tr' => 'Allah\'ı tanıyan kendini tanır.',
            ],
            [
                'kz' => 'Дүние - өлексе, оны иттер ғана жейді.',
                'ru' => 'Мир этот — падаль, и едят ее только собаки.',
                'en' => 'This world is carrion, and only dogs eat it.',
                'tr' => 'Dünya leştir, onu sadece köpekler yer.',
            ],
        ];

        foreach ($quotes as $text) {
            $quote = Quote::create(['is_active' => true]);

            $quote->setTranslation('text', 'kz', $text['kz']);
            $quote->setTranslation('text', 'ru', $text['ru']);
            $quote->setTranslation('text', 'en', $text['en']);
            $quote->setTranslation('text', 'tr', $text['tr']);
        }
    }
}
