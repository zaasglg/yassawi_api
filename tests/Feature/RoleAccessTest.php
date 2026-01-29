<?php

namespace Tests\Feature;

use App\Models\ForumCategory;
use App\Models\Question;
use App\Models\Test;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_submit_test(): void
    {
        $user = User::create([
            'name' => 'Just User',
            'phone' => '+77000000099',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        Sanctum::actingAs($user);

        $test = Test::create(['title' => 'Test', 'is_active' => true]);
        $question = \App\Models\Question::create([
            'test_id' => $test->id,
            'question' => ['text' => 'Q?'],
            'correct_answer' => 'A',
            'options' => [],
        ]);

        $response = $this->postJson("/api/v1/tests/{$test->id}/submit", [
            'answers' => [
                $question->id => 'A',
            ],
        ]);

        // Now user can submit test
        $response->assertStatus(201);
    }

    public function test_admin_can_access_everything(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'phone' => '+77009998877',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        Sanctum::actingAs($admin);

        // Can create post
        $category = ForumCategory::create([
            'name' => 'Test Category',
            'slug' => 'test-category',
            'icon_name' => 'test',
            'color_code' => '#000',
        ]);
        $this->postJson('/api/v1/forum/topics', [
            'title' => 'Admin Post',
            'content' => 'Content',
            'category_id' => $category->id,
        ])->assertStatus(201);

        // Can submit test
        $test = Test::create(['title' => 'Admin Test', 'is_active' => true]);
        $q = \App\Models\Question::create([
            'test_id' => $test->id,
            'question' => ['text' => 'Q'],
            'correct_answer' => 'A',
            'options' => [],
        ]);

        $this->postJson("/api/v1/tests/{$test->id}/submit", ['answers' => [$q->id => 'A']])
            ->assertStatus(201);
    }
}
