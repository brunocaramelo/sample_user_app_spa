<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Controllers\RegisterController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class RememberPassControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        \Artisan::call('db:seed');
    }

    public function test_doRememberPassword_sends_password_reset_email()
    {

        $email = 'admin@test.com';
        $response = $this->postJson('/api/remember-password', ['email' => $email]);

        $response->assertStatus(200);

    }

    public function test_doRememberPassword_with_invalid_email_returns_error()
    {
        $email = 'invalid@test.com';

        $response = $this->postJson('/api/remember-password', ['email' => $email]);

        $response->assertStatus(400);

        $response->assertJson([
            'message' => 'Email não localizado',
        ]);
    }
}
