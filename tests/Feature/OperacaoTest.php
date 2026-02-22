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

    public function test_transferir(): void 
    {
        $id = 1;

        $dados = [
            'carteira_id' => 1,
            'descricao' => "depósito",
            'valor' => 100.00,
            'status' => 'Aprovado'            
        ];

        $mock = Mockery::mock(OperacaoRepository::class);

        $mock->shouldReceive('transferir')
                ->once()
                ->with($dados)
                ->andReturn(true);

        $this->app->instance(OperacaoRepository::class, $mock);

        $service = app(OperacaoService::class);

        $result = $service->transferir($dados);
       
        $this->assertTrue($result);
    }

    public function test_revisar(): void 
    {
        $id = 1;
        $msg = "Teste";

        $mock = Mockery::mock(OperacaoRepository::class);

        $mock->shouldReceive('revisar')
                ->once()
                ->with($id,$msg)
                ->andReturn(true);

        $this->app->instance(OperacaoRepository::class, $mock);

        $service = app(OperacaoService::class);

        $result = $service->revisar($id,$msg);

        $this->assertTrue($result);
    }

    public function test_listar(): void 
    {
        $carteira_id = 1;

        $dados = [
            'carteira_id' => 1,
            'descricao' => "depósito",
            'valor' => 100.00,
            'status' => 'Aprovado'            
        ];

        $mock = Mockery::mock(OperacaoRepository::class);

        $mock->shouldReceive('listar')
                ->once()
                ->with($carteira_id)
                ->andReturn($dados);

        $this->app->instance(OperacaoRepository::class, $mock);

        $service = app(OperacaoService::class);

        $result = $service->listar($carteira_id);

        $this->assertEquals(100.00,$result->valor);
        $this->assertEquals(1,$result->carteira_id);
    }

    public function test_buscar(): void 
    {
        $id = 1;

        $dados = [
            'carteira_id' => 1,
            'descricao' => "transferência",
            'valor' => 100.00,
            'status' => 'Aprovado'            
        ];

        $mock = Mockery::mock(OperacaoRepository::class);

        $mock->shouldReceive('buscar')
                ->once()
                ->with($id)
                ->andReturn(new Operacao($dados));

        $this->app->instance(OperacaoRepository::class, $mock);

        $service = app(OperacaoService::class);

        $result = $service->buscar($id);

        $this->assertEquals("transferência",$result->descricao);
        $this->assertEquals("Aprovado",$result->status);
    }
}
