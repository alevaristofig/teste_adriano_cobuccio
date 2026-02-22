<?php

namespace App\Repository\Impl;

use App\Repository\OperacaoRepository;
use App\Models\Operacao;
use App\Models\Carteira;

class OperacaoRepositoryImpl implements OperacaoRepository
{
    private $modelOperacao;
    private $modelCarteira;

    public function __construct(Operacao $operacao, Carteira $carteira) 
    {
        $this->modelOperacao = $operacao;
        $this->modelCarteira = $carteira;
    }

    public function listar(int $carteira_id): Collection 
    {
        $this->model->modelOperacao->where('carteira_id', $carteira_id);
    }

    public function buscar(int $id): Operacao 
    {
        return  $this->model->modelOperacao->find($id);
    }

    public function depositar(array $dados): Operacao 
    {
       return $this->model->create($dados);
    }

    public function transferir(array $dados): bool
    {
        $carteiraRecebedor = $this->buscarSaldo($dados->user_id);
        $carteiraPagador = $this->buscarSaldo(auth('api')->user()->id);      

        if($carteiraPagador->saldo < 0) {
                $carteiraPagador->status = "Pendência";
        } else {
           $carteiraRecebedor->status = "Concluído";
           $carteiraPagador->status = "Concluído";
        }

        $carteiraRecebedor->saldo+= $dados->valor;         
        $carteiraPagador->saldo-= $dados->valor;
        
        $carteiraRecebedor->save();
        $carteiraPagador->save();

        $this->modelOperacao->create($this->montarDadosOperacao($carteiraRecebedor));
        $this->modelOperacao->create($this->montarDadosOperacao($carteiraPagador));

        return true;
    }

    public function revisar(int $id, string $msg): bool
    {
        $operacao = $this->modelOperacao->find($id);

        $operacao->descricao = $msg;

        return $operacao->save();
    }

    private function buscarCarteira(int $userId): int 
    {
        return $this->model->where('user_id',$userId)->where('numero',$numero)->get();
    }

    private function montarDadosOperacao(array $dados) {
        return [
            'carteira_id' => $dados->id,
            'descricao' => "transferencia",
            'valor' => $dados->saldo,
            'status' => $dados->status   
        ];
    }
}