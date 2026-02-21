<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery;

use App\Service\CarteiraService;
use App\Models\Carteira;

class CarteiraTest extends TestCase
{
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

    public function test_transferir(): void 
    {
        $id = 1;

        $dados = [
            'user_id' => 1,
            'numero' => 1,
            'valor' => 50.00,
            'status' => 'Aprovado'            
        ];

        $dadosSaldo = [
            'user_id' => 1,
            'numero' => 1,
        ];

        $dadosResultSaldo = [
            'valor' => 100
        ];

        $mock = Mockery::mock('alias:' . CarteiraService::class);

        $mock->shouldReceive('buscar')
            ->once()
            ->with($dadosSaldo)
            ->andReturn((object) $dadosResultSaldo);

        $result = CarteiraService::buscar($dados);

        $dados['valor'] = $dados['valor'] - $dadosResultSaldo['valor'];

        $mock2 = Mockery::mock('alias:' . Carteira::class);

        $mock2->shouldReceive('create')
            ->once()
            ->with($id)
            ->andReturn((object) $dados);

        $result = Carteira::create($dados);

        $this->assertEquals(50.00,$result->valor);
        $this->assertEquals(1,$result->user_id);
    }
}
