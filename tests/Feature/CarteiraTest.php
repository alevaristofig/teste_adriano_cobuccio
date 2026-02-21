<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery;

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

        $mock = Mockery::mock('alias:' . Carteira::class);

        $mock->shouldReceive('create')
            ->once()
            ->with($dados)
            ->andReturn((object) $dados);

        $result = Carteira::depositar($dados);

        $this->assertEquals(100.00,$result->valor);
        $this->assertEquals(1,$result->fornecedor_id);
    }
}
