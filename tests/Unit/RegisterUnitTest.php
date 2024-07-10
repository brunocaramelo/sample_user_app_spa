<?php

namespace Tests\Feature\Http\Controllers;

use App\Services\AuthService;
use App\Repositories\UserRepository;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class RegisterUnitTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        \Artisan::call('db:seed');
    }

    public function test_doRegister_has_success()
    {

        $payload = [
            'name' => 'Success',
            'email' => 'email10@test.com',
            'password' => 'password',
            'confirm_password' => 'password',
            'lastname' => 'Register',
            'cep' => '03432100',
            'street' => 'Rua s',
            'city' => 'Cidade s',
            'street_number' => '12A',
            'state' => 'Estado s',
            'neighborhood' => 'Bairro s',
        ];

        $response = (new AuthService(new UserRepository()))->doRegisterUser($payload);

        $this->assertArrayHasKey('status', $response);
        $this->assertArrayHasKey('message', $response);

        $this->assertEquals('success', $response['status']);
    }


}
