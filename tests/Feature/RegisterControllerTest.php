<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Controllers\RegisterController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
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

        $response = $this->postJson('/api/register', $payload);

        $response->assertStatus(200);

    }
    public function test_doRegister_cep_invalid()
    {

        $payload = [
            'name' => 'Success',
            'email' => 'email10@test.com',
            'password' => 'password',
            'confirm_password' => 'password',
            'lastname' => 'Register',
            'cep' => '02334899',
            'street' => 'Rua s',
            'city' => 'Cidade s',
            'street_number' => '12A',
            'state' => 'Estado s',
            'neighborhood' => 'Bairro s',
        ];

        $response = $this->postJson('/api/register', $payload);

        $response->assertStatus(400);

        $response->assertJsonStructure([
            'message',
        ]);

    }

    public function test_doRegister_fields_empty()
    {
        $payload = [
            'name' => 'Success',
            'email' => null,
            'password' => 'password',
            'confirm_password' => null,
            'lastname' => 'Register',
            'cep' => '02334899',
            'street' => 'Rua s',
            'city' => 'Cidade s',
            'street_number' => '12A',
            'state' => 'Estado s',
            'neighborhood' => 'Bairro s',
        ];


        $response = $this->postJson('/api/register', $payload);

        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'confirm_password'
            ],
        ]);
    }


}
