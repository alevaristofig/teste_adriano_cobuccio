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

    public function listar(int $id): Collection 
    {
        return $this->model->whereHas('carteira', function($query) use ($id) {
            $query->where('user_id', $id);
        })
        ->with('carteira')
        ->get();
    }

    public function buscar(int $id): Collection 
    {
        return  $this->model->where('id',$id)->get();
    }

    public function depositar(array $dados): Operacao 
    {
       return $this->model->create($dados);
    }

    public function transferir(array $dados, array $dadosUsuarios): bool
    {        
        $carteiraRecebedor = $dadosUsuarios[0];
        $carteiraPagador = $dadosUsuarios[1];                                

        $this->model->create($this->montarDadosOperacao($carteiraRecebedor));
        $this->model->create($this->montarDadosOperacao($carteiraPagador));


        return true;
    }

    public function revisar(array $dados): bool
    {
        $operacao = $this->model->find($dados['id']);

        $operacao->descricao = $dados['descricao'];
        $operacao->status = "Pendente";

        return $operacao->save();
    }    

    private function montarDadosOperacao(Collection $dados) {
        return [
            'carteira_id' => $dados[0]->id,
            'tipo_operacao' => "transferência",
            'valor' => $dados[0]->saldo,
            'status' => $dados[0]->status
        ];
    }
}