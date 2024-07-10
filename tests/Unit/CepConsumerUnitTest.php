<?php

namespace Tests\Feature\Http\Controllers;

use App\Consumers\CepFinderConsumer;

use App\Exceptions\CepNotFoundException;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class CepConsumerUnitTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        \Artisan::call('db:seed');
    }

    public function test_doRegister_has_success()
    {
        $cep = '03432100';

        $response = (new CepFinderConsumer())->find($cep);

        $this->assertArrayHasKey('cep', $response);
        $this->assertArrayHasKey('street', $response);
        $this->assertArrayHasKey('state', $response);

        $this->assertEquals($cep, $response['cep']);
    }
    public function test_doRegister_has_fail()
    {
        $cep = '11132110';

        $this->expectException(CepNotFoundException::class);

        (new CepFinderConsumer())->find($cep);

    }


}
