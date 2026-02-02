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
                    'kz' => 'Ахмет Ясауи 1093 жылы Сайрам қаласында дүниеге келген. Бала кезінен діни білімге қызығып, рухани тәрбие алды. Отбасының ықпалы оның ерте қалыптасуына әсер етті...',
                    'ru' => 'Ахмет Ясави родился в 1093 году в городе Сайрам. С ранних лет интересовался религиозными знаниями и получил духовное воспитание. Влияние семьи сыграло заметную роль в его становлении...',
                    'en' => 'Ahmed Yasawi was born in 1093 in the city of Sayram. From an early age he was drawn to religious learning and received spiritual guidance. Family influence played a key role in his early formation...',
                    'tr' => 'Ahmed Yesevi 1093 yılında Sayram şehrinde doğdu. Küçük yaşlardan itibaren dini ilimlere ilgi duydu ve manevi eğitim aldı. Ailesinin etkisi erken dönem kişiliğini şekillendirdi...',
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
                    'kz' => 'Алғашқы білімін әкесі Ибраһим атадан алған. Кейін рухани білімін тереңдетіп, ұстаздарымен бірге медреселік және сопылық ілімдерді меңгерді...',
                    'ru' => 'Первые знания получил от своего отца Ибрагима. Затем углубил образование у наставников, изучая медресские и суфийские науки...',
                    'en' => 'He received his first knowledge from his father Ibrahim. He later deepened his studies with mentors, learning madrasa disciplines and Sufi teachings...',
                    'tr' => 'İlk eğitimini babası İbrahim\'den aldı. Daha sonra hocalarıyla birlikte medrese ilimleri ve tasavvufi öğretileri derinleştirdi...',
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
                    'kz' => 'Аңыздарда Арслан баба Ясауидің рухани ұстазы ретінде аталады. Ол арқылы Ясауи дәстүрлі ілімдермен танысып, рухани тәртіп пен қызмет мәнін түсінді...',
                    'ru' => 'В легендах Арслан Баба упоминается как духовный наставник Ясави. Через него Ясави приобщился к традиционным учениям и понял смысл духовной дисциплины и служения...',
                    'en' => 'Legends mention Arslan Baba as Yasawi’s spiritual mentor. Through him Yasawi engaged with classical teachings and learned the meaning of spiritual discipline and service...',
                    'tr' => 'Efsanelerde Arslan Baba, Yesevi’nin manevi rehberi olarak anılır. Yesevi onun aracılığıyla geleneksel ilimleri tanıdı, manevi disiplin ve hizmet anlayışını benimsedi...',
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
                    'kz' => 'Ясауи сопылық ілімді түркі дүниесіне түсінікті тілде жеткізді. Ол рухани тәжірибе, өзін-өзі тану және қоғамға қызмет ету идеясын кеңінен насихаттады...',
                    'ru' => 'Ясави донёс суфийское учение на понятном тюркскому миру языке. Он широко пропагандировал идеи духовного опыта, самопознания и служения обществу...',
                    'en' => 'Yasawi conveyed Sufi teachings in a language accessible to the Turkic world. He promoted ideas of spiritual experience, self-knowledge, and service to society...',
                    'tr' => 'Yesevi, tasavvuf öğretilerini Türk dünyasına anlaşılır bir dilde aktardı. Manevi tecrübe, kendini tanıma ve topluma hizmet fikrini yaygınlaştırdı...',
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
                    'kz' => '«Диуани Хикмет» арқылы рухани-этикалық құндылықтар тарады. Хикметтер халыққа түсінікті түрде жазылып, имандылық, сабыр, адалдық секілді ұстанымдарды насихаттады...',
                    'ru' => 'Через «Диван-и Хикмет» распространялись духовно-нравственные ценности. Хикметы были написаны простым языком и пропагандировали веру, терпение и честность...',
                    'en' => 'Through the “Divan-i Hikmet,” spiritual and ethical values were shared. The Hikmets used accessible language and emphasized faith, patience, and integrity...',
                    'tr' => '“Divan-ı Hikmet” aracılığıyla manevi ve ahlaki değerler yayıldı. Hikmetler sade bir dille yazıldı ve iman, sabır, doğruluk gibi ilkeleri öne çıkardı...',
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
                    'kz' => 'Ясауи өмірінің маңызды бөлігі Түркістанда өтті. Бұл кезеңде ол шәкірт тәрбиелеп, ілімін жүйеледі және рухани орталық қалыптастырды...',
                    'ru' => 'Важная часть жизни Ясави прошла в Туркестане. В этот период он воспитывал учеников, систематизировал учение и сформировал духовный центр...',
                    'en' => 'A significant part of Yasawi’s life was spent in Turkistan. During this period he taught disciples, systematized his teachings, and shaped a spiritual center...',
                    'tr' => 'Yesevi’nin hayatının önemli bir bölümü Türkistan’da geçti. Bu dönemde öğrenciler yetiştirdi, öğretisini sistemleştirdi ve manevi bir merkez oluşturdu...',
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
                    'kz' => 'Кесене Әмір Темір дәуірінде салынған тарихи ескерткіш. Ол Орта Азия сәулет өнерінің көрнекті үлгісі болып саналады және зиярат орны ретінде белгілі...',
                    'ru' => 'Мавзолей — исторический памятник, построенный в эпоху Тимура. Он считается выдающимся образцом архитектуры Центральной Азии и известен как место паломничества...',
                    'en' => 'The mausoleum is a historical monument built in the era of Timur. It is regarded as a landmark of Central Asian architecture and a known place of pilgrimage...',
                    'tr' => 'Türbe, Timur döneminde inşa edilen tarihi bir anıttır. Orta Asya mimarisinin seçkin örneklerinden sayılır ve bir ziyaretgah olarak bilinir...',
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
                    'kz' => 'Ясауи ілімі Орталық Азиядағы рухани өмірге зор ықпал етті. Оның шәкірттері ілімді кең таратып, дәстүрді кейінгі ұрпаққа жеткізді...',
                    'ru' => 'Учение Ясави оказало большое влияние на духовную жизнь Центральной Азии. Его ученики распространили учение и передали традицию следующим поколениям...',
                    'en' => 'Yasawi’s teachings had a major impact on Central Asia’s spiritual life. His students spread the teaching widely and passed the tradition to later generations...',
                    'tr' => 'Yesevi’nin öğretisi Orta Asya’nın manevi hayatını derinden etkiledi. Öğrencileri öğretisini yaydı ve geleneği sonraki nesillere aktardı...',
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
