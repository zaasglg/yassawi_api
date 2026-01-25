<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Schema;

class PostsSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Post::truncate();
        Schema::enableForeignKeyConstraints();

        $user = User::first();
        if (!$user) {
            $user = User::factory()->create();
        }

        $posts = [
            [
                'title' => [
                    'kz' => 'Жаңа көрме ашылды',
                    'ru' => 'Открылась новая выставка',
                    'en' => 'New exhibition opened',
                    'tr' => 'Yeni sergi açıldı',
                ],
                'content' => [
                    'kz' => 'Бүгін мұражайда "Ясауи мұрасы" атты көрме ашылды.',
                    'ru' => 'Сегодня в музее открылась выставка "Наследие Ясави".',
                    'en' => 'Today the exhibition "Yasawi Heritage" opened in the museum.',
                    'tr' => 'Bugün müzede "Yesevi Mirası" sergisi açıldı.',
                ],
            ],
            [
                'title' => [
                    'kz' => 'Конференцияға шақыру',
                    'ru' => 'Приглашение на конференцию',
                    'en' => 'Invitation to the conference',
                    'tr' => 'Konferansa davet',
                ],
                'content' => [
                    'kz' => 'Барлық ғалымдарды халықаралық конференцияға шақырамыз.',
                    'ru' => 'Приглашаем всех ученых на международную конференцию.',
                    'en' => 'We invite all scientists to the international conference.',
                    'tr' => 'Tüm bilim insanlarını uluslararası konferansa davet ediyoruz.',
                ],
            ],
        ];

        foreach ($posts as $data) {
            $post = Post::create([
                'user_id' => $user->id,
                'is_active' => true,
            ]);

            foreach (['kz', 'ru', 'en', 'tr'] as $locale) {
                $post->setTranslation('title', $locale, $data['title'][$locale]);
                $post->setTranslation('content', $locale, $data['content'][$locale]);
            }
        }
    }
}
