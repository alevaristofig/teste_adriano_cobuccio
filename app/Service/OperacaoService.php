<?php

namespace App\Service;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

use App\Repository\OperacaoRepository;
use App\Http\Requests\OperacaoRequest;
use App\Models\Operacao;

class OperacaoService  
{
    private $repositorio;
    private $carteiraService;

    public function __construct(OperacaoRepository $repositorio, CarteiraService $carteiraService) 
    {
        $this->repositorio = $repositorio;
        $this->carteiraService = $carteiraService;
    }

    public function listar(int $id): Collection 
    {
        return $this->repositorio->listar($id);
    }

    public function buscar(int $id): Collection 
    {
        return $this->repositorio->buscar($id);
    }

    public function depositar(array $dados): Operacao 
    {
        try {
            return DB::transaction(function () use ($dados) {                
                $carteira = $this->carteiraService->buscarCarteiraPagador(auth('api')->user()->id);
                $valor = (double) ($dados['valor']);                
                $valor = $valor - $carteira[0]->valorNegativo;
               
                $carteira[0]->valorNegativo = 0;
                $carteira[0]->saldo+= $valor;

                $this->carteiraService->atualizar($carteira);
                        
                return $this->repositorio->depositar($dados);
            });   
        } catch(\Exception $e) {            
            throw new \RuntimeException('Erro ao processar depósito');
        }
    }

    public function transferir(array $dados): bool 
    {
        try {    
            return DB::transaction(function () use ($dados) {
                $carteiraRecebedor = $this->carteiraService->buscarCarteiraRecebedor($dados['carteira_id']);                          
                $carteiraPagador = $this->carteiraService->buscarCarteiraPagador(auth('api')->user()->id); 

                if($carteiraPagador[0]->saldo < 0) 
                {
                    $carteiraPagador[0]->status = "Pendência";
                    $carteiraPagador[0]->valorNegativo = $dados['valor'];
                } 
                else 
                {
                    $carteiraRecebedor[0]->status = "Concluído";
                    $carteiraPagador[0]->status = "Concluído";
                }

                $carteiraRecebedor[0]->saldo+= $dados['valor'];               
                $carteiraPagador[0]->saldo-= $dados['valor'];   
                        
                $operacaoUsuarios = [$carteiraRecebedor,$carteiraPagador];

                $this->repositorio->transferir($dados, $operacaoUsuarios);

                $this->carteiraService->atualizar($carteiraRecebedor);
                $this->carteiraService->atualizar($carteiraPagador);

                return true;
            });               
        } catch(\Exception $e) {            
            throw new \RuntimeException('Erro ao processa a transferência');            
        }
    }

    public function revisar(array $dados): bool
    {
        try {                                        
            return $this->repositorio->revisar($dados);
        } catch(\Exception $e) {            
            throw new \RuntimeException('Erro ao processa a revisão');            
        }
    }
}