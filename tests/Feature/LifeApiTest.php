<?php

namespace Tests\Feature;

use App\Models\LifeSection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LifeApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_life_index_returns_list(): void
    {
        LifeSection::create([
            'title' => 'Test Section',
            'slug' => 'test-section',
            'content' => 'Test Content',
            'order' => 1,
        ]);

        $response = $this->getJson('/api/v1/life');

        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => ['id', 'title', 'slug'],
            ]);
    }

    public function test_life_show_by_slug(): void
    {
        $section = LifeSection::create([
            'title' => 'Detail Section',
            'slug' => 'detail-section',
            'content' => 'Detail Content',
            'order' => 1,
        ]);

        $response = $this->getJson('/api/v1/life/detail-section');

        $response->assertStatus(200)
            ->assertJson([
                'id' => $section->id,
                'slug' => 'detail-section',
                'title' => 'Detail Section',
            ]);
    }
}
