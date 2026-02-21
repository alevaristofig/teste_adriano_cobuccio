<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery;

use App\Service\CarteiraService;

class CarteiraTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_depositar(): void
    {
        $dados = [
            'user_id' => 1,
            'numero' => 001,
            'valor' => 100.00,
            'status' => 'Aprovado'            
        ];

        $mock = Mockery::mock('alias:' . CarteiraService::class);

        $mock->shouldReceive('depositar')
            ->once()
            ->with($dados)
            ->andReturn((object) $dados);

        $result = CarteiraService::depositar($dados);

        $this->assertEquals(100.00,$result->valor);
        $this->assertEquals(1,$result->user_id);
    }
}
