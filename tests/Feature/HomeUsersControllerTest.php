<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Controllers\RegisterController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class HomeUsersControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        \Artisan::call('migrate');
        \Artisan::call('db:seed');
    }

    public function test_doRememberPassword_sends_password_reset_email()
    {

        $response = $this->getJson('/api/home/users');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'current_page',
            'data',
        ]);

    }

}
