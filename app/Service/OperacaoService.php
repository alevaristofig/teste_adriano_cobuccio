<?php

namespace App\Service;

use Illuminate\Database\Eloquent\Collection;

use App\Repository\OperacaoRepository;
use App\Http\Requests\OperacaoRequest;
use App\Models\Operacao;

class OperacaoService  
{
    private $repositorio;

    public function __construct(OperacaoRepository $repositorio) 
    {
        $this->repositorio = $repositorio;
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
            return $this->repositorio->depositar($dados);
        } catch(\Exception $e) {
            dd($e->getMessage());
            throw new \RuntimeException('Erro ao processar depósito');
        }
    }

    public function transferir(array $dados): bool 
    {
        try {                              
            return $this->repositorio->transferir($dados);
        } catch(\Exception $e) {
            dd($e->getMessage());
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