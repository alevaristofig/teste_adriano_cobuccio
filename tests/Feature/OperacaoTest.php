<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery;

use App\Repository\OperacaoRepository;
use App\Service\OperacaoService;
use App\Models\Operacao;

class OperacaoTest extends TestCase
{
    public function test_depositar(): void
    {
        $dados = [
            'carteira_id' => 1,
            'descricao' => "depósito",
            'valor' => 100.00,
            'status' => 'Aprovado'            
        ];

        $mock = Mockery::mock(OperacaoRepository::class);

        $mock->shouldReceive('depositar')
                ->once()
                ->with($dados)
                ->andReturn(new Operacao($dados));

        $this->app->instance(OperacaoRepository::class, $mock);

        $service = app(OperacaoService::class);

        $result = $service->depositar($dados);

        $this->assertEquals(100.00,$result->valor);
        $this->assertEquals(1,$result->carteira_id);
        $this->assertEquals("depósito",$result->descricao);
    }
}
