<?php

namespace App\Repository\Impl;

use Illuminate\Database\Eloquent\Collection;

use App\Repository\OperacaoRepository;
use App\Models\Operacao;
use App\Models\Carteira;

class OperacaoRepositoryImpl implements OperacaoRepository
{
    private $model;
    private $modelCarteira;

    public function __construct(Operacao $operacao, Carteira $carteira) 
    {
        $this->model = $operacao;
        $this->modelCarteira = $carteira;
    }

    /*public function listar(int $carteira_id): Collection 
    {
        $this->model->modelOperacao->where('carteira_id', $carteira_id);
    }*/

    public function buscar(int $id): Operacao 
    {
        return  $this->model->find($id);
    }

    public function depositar(array $dados): Operacao 
    {
       return $this->model->create($dados);
    }

    //Refatorar
    public function transferir(array $dados): bool
    {        
        $carteiraRecebedor = $this->buscarCarteiraRecebedor($dados['carteira_id']);      
        $carteiraPagador = $this->buscarCarteiraPagador(auth('api')->user()->id);      

        if($carteiraPagador[0]->saldo < 0) {
                $carteiraPagador[0]->status = "Pendência";
                $carteiraPagador[0]->valorNegativo = $dados['valor'];
        } else {
           $carteiraRecebedor[0]->status = "Concluído";
           $carteiraPagador[0]->status = "Concluído";
        }

        $carteiraRecebedor[0]->saldo+= $dados['valor'];               
        $carteiraPagador[0]->saldo-= $dados['valor'];        

        $this->model->create($this->montarDadosOperacao($carteiraRecebedor));
        $this->model->create($this->montarDadosOperacao($carteiraPagador));


        return true;
    }

    public function revisar(int $id, string $msg): bool
    {
        $operacao = $this->modelOperacao->find($id);

        $operacao->descricao = $msg;

        return $operacao->save();
    }

    private function buscarCarteiraPagador(int $userId): Collection 
    {
        return $this->modelCarteira->where('user_id',$userId)->get();
    }

    private function buscarCarteiraRecebedor(int $id): Collection 
    {
        return $this->modelCarteira->where('id',$id)->get();
    }

    private function montarDadosOperacao(Collection $dados) {
        return [
            'carteira_id' => $dados[0]->id,
            'descricao' => "transferencia",
            'valor' => $dados[0]->saldo,
            'status' => $dados[0]->status
        ];
    }
}