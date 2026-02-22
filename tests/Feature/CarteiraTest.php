<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery;

use App\Repository\CarteiraRepository;
use App\Service\CarteiraService;
use App\Models\Carteira;

class CarteiraTest extends TestCase
{
    public function test_InserirCarteiraSucesso(): void 
    {
        $dados = [
            'user_id' => 1,
            'numero' => 1,
            'titular' => "Alexandre Figueiredo",
            'saldo' => 100            
        ];

        $mock = Mockery::mock(CarteiraRepository::class);

        $mock->shouldReceive('salvar')
            ->once()
            ->with($dados)
            ->andReturn(new Carteira($dados));

        $this->app->instance(CarteiraRepository::class, $mock);

        $service = app(CarteiraService::class);

        $result = $service->salvar($dados);

        $this->assertEquals(100,$result->saldo);
        $this->assertEquals("Alexandre Figueiredo",$result->titular);
    }

    public function test_BuscarCarteiraSucesso(): void 
    {
        $id = 1;

        $dados = [
            'id' => 1,
            'user_id' => 1,
            'numero' => 1,
            'titular' => "Alexandre Figueiredo",
            'saldo' => 100            
        ];

        $mock = Mockery::mock(CarteiraRepository::class);

        $mock->shouldReceive('buscar')
            ->once()    
            ->with($id)        
            ->andReturn(new Carteira($dados));

        $this->app->instance(CarteiraRepository::class, $mock);

        $service = app(CarteiraService::class);

        $result = $service->buscar($id);

        $this->assertEquals(1,$result->id);
        $this->assertEquals(1,$result->user_id);
    }

    public function test_AtualizarPedidoSucesso(): void 
    {
        $id = 1;

        $dados = [
            'id' => 1,
            'user_id' => 1,
            'numero' => 1,
            'titular' => "Alexandre Figueiredo",
            'saldo' => 100            
        ];

        $mock = Mockery::mock(CarteiraRepository::class);

        $mock->shouldReceive('buscar')
            ->once()    
            ->with($id)        
            ->andReturn(new Carteira($dados));

        $this->app->instance(CarteiraRepository::class, $mock);

        $service = app(CarteiraService::class);

        $carteiraUpdate = $service->buscar($id);
        
        $carteiraUpdate->saldo = 120;
        $carteiraUpdate->titular = "Alexandre Evaristo Figueiredo";       

        $mock->shouldReceive('atualizar')
            ->once()
            ->with($carteiraUpdate)
            ->andReturn(new Carteira($carteiraUpdate));

        $resultUpdate = $service->atualizar($carteiraUpdate);
        
        $this->assertEquals(120,$resultUpdate->saldo);    
        $this->assertEquals("Alexandre Evaristo Figueiredo",$resultUpdate->titular);    
    }

    public function test_DeletarCarteiraSucesso(): void 
    {
        $id = 1;
        $carteira = new Carteira();

        $mock = Mockery::mock('alias:' . CarteiraService::class);
        $mock->shouldReceive('buscar')
            ->once()    
            ->with($id)        
            ->andReturn($carteira);

        $carteiraDel = CarteiraService::buscar($id);        

        $mock->shouldReceive('remover')
            ->once()
            ->with($id)
            ->andReturnTrue();

        $result = CarteiraService::remover($id);
       
        $this->assertTrue($result);                
    }
}
