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

    public function depositar(array $dados): Operacao 
    {
        try {
            return $this->repositorio->depositar($dados);
        } catch(\Exception $e) {
            throw new \RuntimeException('Erro ao processa depósito');
        }
    }

    public function transferir(array $dados): bool 
    {
        try {                              
            return $this->repositorio->transferir($dados);
        } catch(\Exception $e) {
            throw new \RuntimeException('Erro ao processa a transferência');            
        }
    }
}