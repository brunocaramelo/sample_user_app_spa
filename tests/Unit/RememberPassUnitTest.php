<?php

namespace Tests\Feature\Http\Controllers;

use App\Exceptions\UserNotFoundException;
use App\Services\AuthService;
use App\Repositories\UserRepository;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class RememberPassUnitTest extends TestCase
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
        $response = (new AuthService(new UserRepository()))->doRememberPassword($email);

        $this->assertArrayHasKey('status', $response);
        $this->assertArrayHasKey('message', $response);

        $this->assertEquals('success', $response['status']);
    }

    public function test_doRememberPassword_with_invalid_email_returns_error()
    {
        $email = 'invalid@test.com';

        $this->expectException(UserNotFoundException::class);

        (new AuthService(new UserRepository()))->doRememberPassword($email);

    }
}
