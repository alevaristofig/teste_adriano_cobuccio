<?php

namespace App\Service;

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

    public function listar(int $carteira_id): Collection 
    {
        return $this->repositorio->listar($carteira_id);
    }

    public function buscar(int $id): Operacao 
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

    public function revisar(int $id, string $msg): bool
    {
        try {                              
            return $this->repositorio->revisar($id, $msg);
        } catch(\Exception $e) {
            throw new \RuntimeException('Erro ao processa a revisão');            
        }
    }
}