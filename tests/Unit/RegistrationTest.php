<?php

namespace Tests\Feature\Auth;

use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register/token');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        // Log the response for debugging
        \Log::info($response->getContent());

        // Check if the user is authenticated
        $this->assertTrue(Auth::check(), 'User is not authenticated');

        // Assert other conditions
        $response->assertStatus(302); // Check for a redirect response
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]); // Check if the user is in the database
    }
}
