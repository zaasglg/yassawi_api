<?php

namespace Database\Seeders;

use App\Models\ForumCategory;
use Illuminate\Database\Seeder;

class ForumCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'General Discussion',
                'slug' => 'general-discussion',
                'icon_name' => 'chat_bubble',
                'color_code' => '#3B82F6', // Blue
            ],
            [
                'name' => 'Questions',
                'slug' => 'questions',
                'icon_name' => 'help_outline',
                'color_code' => '#EF4444', // Red
            ],
            [
                'name' => 'History',
                'slug' => 'history',
                'icon_name' => 'history_edu',
                'color_code' => '#D97706', // Amber
            ],
            [
                'name' => 'Religion',
                'slug' => 'religion',
                'icon_name' => 'menu_book',
                'color_code' => '#10B981', // Green
            ],
            [
                'name' => 'Culture',
                'slug' => 'culture',
                'icon_name' => 'theater_comedy',
                'color_code' => '#8B5CF6', // Purple
            ],
        ];

        foreach ($categories as $category) {
            ForumCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
