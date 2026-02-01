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
                [
                    'correct_answer' => '1166',
                    'question' => [
                        'kz' => 'Ахмет Ясауи қай жылы қайтыс болды?',
                        'ru' => 'В каком году умер Ахмет Ясави?',
                        'en' => 'In which year did Ahmed Yasawi die?',
                        'tr' => 'Ahmed Yesevi hangi yılda vefat etti?',
                    ],
                    'options' => [
                        'kz' => ['1166', '1120', '1200'],
                        'ru' => ['1166', '1120', '1200'],
                        'en' => ['1166', '1120', '1200'],
                        'tr' => ['1166', '1120', '1200'],
                    ],
                ],
                [
                    'correct_answer' => 'Yesi',
                    'question' => [
                        'kz' => 'Түркістан қаласының көне атауы қандай?',
                        'ru' => 'Какое древнее название города Туркестан?',
                        'en' => 'What is the historical name of Turkistan?',
                        'tr' => 'Türkistan şehrinin eski adı nedir?',
                    ],
                    'options' => [
                        'kz' => ['Yesi', 'Otrar', 'Taraz'],
                        'ru' => ['Yesi', 'Otrar', 'Taraz'],
                        'en' => ['Yesi', 'Otrar', 'Taraz'],
                        'tr' => ['Yesi', 'Otrar', 'Taraz'],
                    ],
                ],
                [
                    'correct_answer' => 'Divan-i Hikmet',
                    'question' => [
                        'kz' => 'Ахмет Ясауидің ең белгілі еңбегі қалай аталады?',
                        'ru' => 'Как называется самый известный труд Ахмета Ясави?',
                        'en' => 'What is Ahmed Yasawi’s most well-known work called?',
                        'tr' => 'Ahmed Yesevi’nin en bilinen eseri nedir?',
                    ],
                    'options' => [
                        'kz' => ['Divan-i Hikmet', 'Kutadgu Bilig', 'Diwan Lughat al-Turk'],
                        'ru' => ['Divan-i Hikmet', 'Kutadgu Bilig', 'Diwan Lughat al-Turk'],
                        'en' => ['Divan-i Hikmet', 'Kutadgu Bilig', 'Diwan Lughat al-Turk'],
                        'tr' => ['Divan-i Hikmet', 'Kutadgu Bilig', 'Diwan Lughat al-Turk'],
                    ],
                ],
                [
                    'correct_answer' => 'Timur',
                    'question' => [
                        'kz' => 'Ясауи кесенесін салдырған билеуші кім?',
                        'ru' => 'Какой правитель распорядился построить мавзолей Ясави?',
                        'en' => 'Which ruler commissioned the Yasawi mausoleum?',
                        'tr' => 'Yesevi türbesini yaptıran hükümdar kimdir?',
                    ],
                    'options' => [
                        'kz' => ['Timur', 'Babur', 'Genghis'],
                        'ru' => ['Timur', 'Babur', 'Genghis'],
                        'en' => ['Timur', 'Babur', 'Genghis'],
                        'tr' => ['Timur', 'Babur', 'Genghis'],
                    ],
                ],
                [
                    'correct_answer' => 'Yasawiya',
                    'question' => [
                        'kz' => 'Ясауидің сопылық жолының атауы қандай?',
                        'ru' => 'Как называется суфийский тарикат Ясави?',
                        'en' => 'What is the name of Yasawi’s sufi order?',
                        'tr' => 'Yesevi’nin tasavvuf yolu nasıl adlandırılır?',
                    ],
                    'options' => [
                        'kz' => ['Yasawiya', 'Naqshbandiyya', 'Qadiriyya'],
                        'ru' => ['Yasawiya', 'Naqshbandiyya', 'Qadiriyya'],
                        'en' => ['Yasawiya', 'Naqshbandiyya', 'Qadiriyya'],
                        'tr' => ['Yasawiya', 'Naqshbandiyya', 'Qadiriyya'],
                    ],
                ],
                [
                    'correct_answer' => '12th',
                    'question' => [
                        'kz' => 'Ахмет Ясауи қай ғасырда өмір сүрді?',
                        'ru' => 'В каком веке жил Ахмет Ясави?',
                        'en' => 'In which century did Ahmed Yasawi live?',
                        'tr' => 'Ahmed Yesevi hangi yüzyılda yaşadı?',
                    ],
                    'options' => [
                        'kz' => ['12th', '10th', '14th'],
                        'ru' => ['12th', '10th', '14th'],
                        'en' => ['12th', '10th', '14th'],
                        'tr' => ['12th', '10th', '14th'],
                    ],
                ],
                [
                    'correct_answer' => 'Turkistan',
                    'question' => [
                        'kz' => 'Ахмет Ясауи қай қалада жерленген?',
                        'ru' => 'В каком городе похоронен Ахмет Ясави?',
                        'en' => 'In which city is Ahmed Yasawi buried?',
                        'tr' => 'Ahmed Yesevi hangi şehirde defnedilmiştir?',
                    ],
                    'options' => [
                        'kz' => ['Turkistan', 'Sairam', 'Otrar'],
                        'ru' => ['Turkistan', 'Sairam', 'Otrar'],
                        'en' => ['Turkistan', 'Sairam', 'Otrar'],
                        'tr' => ['Turkistan', 'Sairam', 'Otrar'],
                    ],
                ],
                [
                    'correct_answer' => 'Sufi',
                    'question' => [
                        'kz' => 'Ахмет Ясауи қандай рухани дәстүрге жатады?',
                        'ru' => 'К какой духовной традиции относится Ахмет Ясави?',
                        'en' => 'Which spiritual tradition does Ahmed Yasawi belong to?',
                        'tr' => 'Ahmed Yesevi hangi manevi geleneğe aittir?',
                    ],
                    'options' => [
                        'kz' => ['Sufi', 'Shaman', 'Buddhist'],
                        'ru' => ['Sufi', 'Shaman', 'Buddhist'],
                        'en' => ['Sufi', 'Shaman', 'Buddhist'],
                        'tr' => ['Sufi', 'Shaman', 'Buddhist'],
                    ],
                ],
                [
                    'correct_answer' => 'Turkic',
                    'question' => [
                        'kz' => 'Ахмет Ясауи шығармаларын негізінен қай тілдік ортада жазды?',
                        'ru' => 'На каком языковом основании писал Ахмет Ясави?',
                        'en' => 'In which linguistic tradition did Ahmed Yasawi primarily write?',
                        'tr' => 'Ahmed Yesevi eserlerini ağırlıkla hangi dil geleneğinde yazdı?',
                    ],
                    'options' => [
                        'kz' => ['Turkic', 'Latin', 'Greek'],
                        'ru' => ['Turkic', 'Latin', 'Greek'],
                        'en' => ['Turkic', 'Latin', 'Greek'],
                        'tr' => ['Turkic', 'Latin', 'Greek'],
                    ],
                ],
                [
                    'correct_answer' => 'Arslan Baba',
                    'question' => [
                        'kz' => 'Ясауидің рухани тәлімгері ретінде аңызда кім аталады?',
                        'ru' => 'Кого в легендах называют духовным наставником Ясави?',
                        'en' => 'Who is named as Yasawi’s spiritual mentor in legends?',
                        'tr' => 'Efsanelerde Yesevi’nin manevi mürşidi olarak kim anılır?',
                    ],
                    'options' => [
                        'kz' => ['Arslan Baba', 'Al-Kindi', 'Ibn Sina'],
                        'ru' => ['Arslan Baba', 'Al-Kindi', 'Ibn Sina'],
                        'en' => ['Arslan Baba', 'Al-Kindi', 'Ibn Sina'],
                        'tr' => ['Arslan Baba', 'Al-Kindi', 'Ibn Sina'],
                    ],
                ],
                [
                    'correct_answer' => 'Hikmet',
                    'question' => [
                        'kz' => 'Ясауи дәстүріндегі өлеңдер қалай аталады?',
                        'ru' => 'Как называются стихотворные наставления в традиции Ясави?',
                        'en' => 'What are the didactic poems in the Yasawi tradition called?',
                        'tr' => 'Yesevi geleneğindeki didaktik şiirler nasıl adlandırılır?',
                    ],
                    'options' => [
                        'kz' => ['Hikmet', 'Qasida', 'Rubai'],
                        'ru' => ['Hikmet', 'Qasida', 'Rubai'],
                        'en' => ['Hikmet', 'Qasida', 'Rubai'],
                        'tr' => ['Hikmet', 'Qasida', 'Rubai'],
                    ],
                ],
                [
                    'correct_answer' => 'Turkistan',
                    'question' => [
                        'kz' => 'Ясауи мұрасымен байланысты негізгі тарихи орталық қай қала?',
                        'ru' => 'Какой город является главным историческим центром наследия Ясави?',
                        'en' => 'Which city is the main historical center of Yasawi’s legacy?',
                        'tr' => 'Yesevi mirasının başlıca tarihi merkezi hangi şehirdir?',
                    ],
                    'options' => [
                        'kz' => ['Turkistan', 'Tashkent', 'Bukhara'],
                        'ru' => ['Turkistan', 'Tashkent', 'Bukhara'],
                        'en' => ['Turkistan', 'Tashkent', 'Bukhara'],
                        'tr' => ['Turkistan', 'Tashkent', 'Bukhara'],
                    ],
                ],
                [
                    'correct_answer' => 'Sufi',
                    'question' => [
                        'kz' => 'Ясауидің еңбектеріндегі негізгі рухани бағыты қандай?',
                        'ru' => 'Какое главное духовное направление в трудах Ясави?',
                        'en' => 'What is the main spiritual orientation in Yasawi’s works?',
                        'tr' => 'Yesevi’nin eserlerindeki temel manevi yönelim nedir?',
                    ],
                    'options' => [
                        'kz' => ['Sufi', 'Stoic', 'Epicurean'],
                        'ru' => ['Sufi', 'Stoic', 'Epicurean'],
                        'en' => ['Sufi', 'Stoic', 'Epicurean'],
                        'tr' => ['Sufi', 'Stoic', 'Epicurean'],
                    ],
                ],
                [
                    'correct_answer' => 'Timur',
                    'question' => [
                        'kz' => 'Ясауи кесенесі қандай дәуірдегі сәулетпен байланысты?',
                        'ru' => 'С архитектурой какой эпохи связан мавзолей Ясави?',
                        'en' => 'The Yasawi mausoleum is associated with which era’s architecture?',
                        'tr' => 'Yesevi türbesi hangi dönemin mimarisiyle ilişkilidir?',
                    ],
                    'options' => [
                        'kz' => ['Timur', 'Seljuk', 'Ottoman'],
                        'ru' => ['Timur', 'Seljuk', 'Ottoman'],
                        'en' => ['Timur', 'Seljuk', 'Ottoman'],
                        'tr' => ['Timur', 'Seljuk', 'Ottoman'],
                    ],
                ],
                [
                    'correct_answer' => 'Divan-i Hikmet',
                    'question' => [
                        'kz' => 'Хикметтер жинағы қалай аталады?',
                        'ru' => 'Как называется сборник хикметов?',
                        'en' => 'What is the collection of Hikmet poems called?',
                        'tr' => 'Hikmetlerin derlemesi nasıl adlandırılır?',
                    ],
                    'options' => [
                        'kz' => ['Divan-i Hikmet', 'Shahnameh', 'Masnavi'],
                        'ru' => ['Divan-i Hikmet', 'Shahnameh', 'Masnavi'],
                        'en' => ['Divan-i Hikmet', 'Shahnameh', 'Masnavi'],
                        'tr' => ['Divan-i Hikmet', 'Shahnameh', 'Masnavi'],
                    ],
                ],
                [
                    'correct_answer' => 'Turkistan',
                    'question' => [
                        'kz' => 'Ясауи кесенесі қазіргі қай қалада орналасқан?',
                        'ru' => 'В каком городе находится мавзолей Ясави сегодня?',
                        'en' => 'Which city hosts the Yasawi mausoleum today?',
                        'tr' => 'Yesevi türbesi günümüzde hangi şehirde bulunur?',
                    ],
                    'options' => [
                        'kz' => ['Turkistan', 'Almaty', 'Shymkent'],
                        'ru' => ['Turkistan', 'Almaty', 'Shymkent'],
                        'en' => ['Turkistan', 'Almaty', 'Shymkent'],
                        'tr' => ['Turkistan', 'Almaty', 'Shymkent'],
                    ],
                ],
                [
                    'correct_answer' => 'Sufi',
                    'question' => [
                        'kz' => 'Ясауидің ілімі ең алдымен қандай бағытқа жатады?',
                        'ru' => 'Учение Ясави прежде всего относится к какому направлению?',
                        'en' => 'Yasawi’s teachings primarily belong to which discipline?',
                        'tr' => 'Yesevi’nin öğretisi öncelikle hangi alana aittir?',
                    ],
                    'options' => [
                        'kz' => ['Sufi', 'Mathematics', 'Astronomy'],
                        'ru' => ['Sufi', 'Mathematics', 'Astronomy'],
                        'en' => ['Sufi', 'Mathematics', 'Astronomy'],
                        'tr' => ['Sufi', 'Mathematics', 'Astronomy'],
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
