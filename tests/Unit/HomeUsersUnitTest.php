<?php

namespace Tests\Feature\Http\Controllers;

use App\Services\AuthService;
use App\Repositories\UserRepository;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class HomeUsersUnitTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        \Artisan::call('db:seed');
    }

    public function test_doRegister_has_success()
    {
        $response = (new AuthService(new UserRepository))->searchUsers([]);

        $this->assertEquals(true, $response->count() > 0);
    }

    public function test_doRegister_has_no_result()
    {
        $response = (new AuthService(new UserRepository))->searchUsers(['name' => 'Is not found']);

        $this->assertEquals(true, $response->count() == 0);

    }


}
