<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class HomeApiTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Artisan::call('db:seed');
    }

    public function test_home_endpoint_returns_quotes_and_life_sections(): void
    {
        $response = $this->getJson('/api/v1/home');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'quotes' => [
                    '*' => ['id', 'text'],
                ],
                'life_sections' => [
                    '*' => ['id', 'title', 'slug'],
                ],
            ]);
    }
}
