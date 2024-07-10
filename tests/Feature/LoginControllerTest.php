<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Controllers\LoginController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        \Artisan::call('db:seed');
    }

    public function test_doLogin_with_valid_credentials_returns_token()
    {
        $loginData = [
            'email' => 'admin@test.com',
            'password' => 'password',
        ];

        $response = $this->postJson('/api/login', $loginData);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'status',
            'message',
            'access_token',
        ]);
    }

    public function test_doLogin_with_invalid_credentials_returns_error()
    {

        $loginData = [
            'email' => 'admin@test.com',
            'password' => 'password-wrong',
        ];

        $response = $this->postJson('/api/login', $loginData);
        $response->assertStatus(400);

        $response->assertJsonStructure([
            'message',
            'status',
        ]);
    }

    public function test_doLogin_with_missing_email_returns_error()
    {
        $loginData = [
            'password' => 'secret',
        ];

        $response = $this->postJson('/api/login', $loginData);
        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'email',
            ],
        ]);
    }
}
