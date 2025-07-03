<?php

namespace Tests\Feature\Http\Controllers;

use App\Services\LoginService;
use App\Repositories\UserRepository;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        \Artisan::call('migrate');
        \Artisan::call('db:seed');
    }

    public function test_doLogin_with_valid_credentials_returns_token()
    {
        $loginData = [
            'email' => 'admin@test.com',
            'password' => 'password',
        ];

        $response = (new LoginService(new UserRepository()))->doLogin($loginData);

        $this->assertArrayHasKey('status', $response);
        $this->assertArrayHasKey('message', $response);
        $this->assertArrayHasKey('access_token', $response);

        $this->assertEquals('success', $response['status']);
    }

    public function test_doLogin_with_invalid_credentials_returns_error()
    {

        $loginData = [
            'email' => 'admin@test.com',
            'password' => 'password-wrong',
        ];

        $response = (new LoginService(new UserRepository()))->doLogin($loginData);

        $this->assertArrayHasKey('status', $response);
        $this->assertArrayHasKey('message', $response);

        $this->assertEquals('fail', $response['status']);

    }

    public function test_doLogin_with_missing_email_returns_error()
    {
        $loginData = [
            'password' => 'secret',
        ];

        $response = (new LoginService(new UserRepository()))->doLogin($loginData);

        $this->assertArrayHasKey('status', $response);
        $this->assertArrayHasKey('message', $response);

        $this->assertEquals('fail', $response['status']);
    }
}
