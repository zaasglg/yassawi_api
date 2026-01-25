<?php

namespace Tests\Feature;

use App\Models\Question;
use App\Models\Test;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class TestsApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_submit_test(): void
    {
        $test = Test::create([
            'title' => 'Sample Test',
            'description' => 'Test Desc',
            'is_active' => true,
        ]);

        $response = $this->postJson("/api/v1/tests/{$test->id}/submit", [
            'answers' => [],
        ]);

        $response->assertStatus(401);
    }

    public function test_student_can_submit_test(): void
    {
        $user = User::create([
            'name' => 'Student',
            'phone' => '+77000000001',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);

        Sanctum::actingAs($user);

        $test = Test::create([
            'title' => 'Math Test',
            'description' => 'Simple Math',
            'is_active' => true,
        ]);

        $question = Question::create([
            'test_id' => $test->id,
            'question' => ['text' => '2 + 2 = ?'],
            'correct_answer' => '4',
            'options' => [
                ['value' => '3', 'label' => '3'],
                ['value' => '4', 'label' => '4'],
                ['value' => '5', 'label' => '5'],
                ['value' => '6', 'label' => '6'],
            ],
        ]);

        $response = $this->postJson("/api/v1/tests/{$test->id}/submit", [
            'answers' => [
                $question->id => '4',
            ],
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'score',
                'test_id',
                'user_id'
            ]);
    }

    public function test_score_is_saved_to_database(): void
    {
        $user = User::create([
            'name' => 'Scorer',
            'phone' => '+77000000002',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);

        Sanctum::actingAs($user);

        $test = Test::create(['title' => 'Score Test', 'is_active' => true]);
        $q1 = Question::create(['test_id' => $test->id, 'question' => ['text' => 'Q1'], 'options' => [], 'correct_answer' => 'A']);
        $q2 = Question::create(['test_id' => $test->id, 'question' => ['text' => 'Q2'], 'options' => [], 'correct_answer' => 'B']);

        $response = $this->postJson("/api/v1/tests/{$test->id}/submit", [
            'answers' => [
                $q1->id => 'A', // Correct
                $q2->id => 'C', // Incorrect
            ],
        ]);

        $this->assertDatabaseHas('test_results', [
            'user_id' => $user->id,
            'test_id' => $test->id,
            'score' => 1,
        ]);
    }
}
