<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ForumApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_create_post(): void
    {
        $response = $this->postJson('/api/v1/forum', [
            'title' => 'Guest Post',
            'content' => 'Content',
        ]);

        $response->assertStatus(401);
    }

    public function test_authenticated_user_can_create_post(): void
    {
        $user = User::create([
            'name' => 'Poster',
            'phone' => '+77000000010',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);

        Sanctum::actingAs($user);

        $response = $this->postJson('/api/v1/forum', [
            'title' => 'My Question',
            'content' => 'How to solve this?',
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'title' => 'My Question',
                'user_id' => $user->id,
            ]);
    }

    public function test_user_can_comment_post(): void
    {
        $author = User::create([
            'name' => 'Author',
            'phone' => '+77000000011',
            'password' => bcrypt('password'),
            'role' => 'teacher',
        ]);

        $post = Post::create([
            'user_id' => $author->id,
            'title' => 'Discussion',
            'content' => 'Let\'s discuss',
            'is_active' => true,
        ]);

        $commenter = User::create([
            'name' => 'Commenter',
            'phone' => '+77000000012',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);

        Sanctum::actingAs($commenter);

        $response = $this->postJson("/api/v1/forum/{$post->id}/comment", [
            'content' => 'I agree!',
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('comments', [
            'post_id' => $post->id,
            'user_id' => $commenter->id,
            'content' => 'I agree!',
        ]);
    }
}
