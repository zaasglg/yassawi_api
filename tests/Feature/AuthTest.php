<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_with_phone(): void
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Test User',
            'phone' => '+77001234567',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'role' => 'student',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'user' => ['id', 'name', 'phone', 'role'],
                'token',
            ]);

        $this->assertDatabaseHas('users', [
            'phone' => '+77001234567',
            'role' => 'student',
        ]);
    }

    public function test_user_can_login_with_phone(): void
    {
        $user = User::create([
            'name' => 'Login User',
            'phone' => '+77009876543',
            'password' => bcrypt('password123'),
            'role' => 'student',
        ]);

        $response = $this->postJson('/api/login', [
            'phone' => '+77009876543',
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'token',
                'user' => ['id', 'name', 'phone'],
            ]);
    }

    public function test_login_fails_with_wrong_password(): void
    {
        $user = User::create([
            'name' => 'Fail User',
            'phone' => '+77001112233',
            'password' => bcrypt('password123'),
            'role' => 'student',
        ]);

        $response = $this->postJson('/api/login', [
            'phone' => '+77001112233',
            'password' => 'wrong_password',
        ]);

        $response->assertStatus(422);
    }
}
