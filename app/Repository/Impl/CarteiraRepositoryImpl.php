<?php

namespace App\Repository\Impl;

use Illuminate\Database\Eloquent\Collection;
use App\Repository\CarteiraRepository;
use App\Models\Carteira;

class CarteiraRepositoryImpl implements CarteiraRepository
{
    private $model;

    public function __construct(Carteira $carteira) 
    {
        $this->model = $carteira;
    }

    public function salvar(array $dados): Carteira 
    {
        return $this->model->create($dados);   
    }

    public function buscar(int $id): Collection 
    {       
        return $this->model->where('user_id',$id)->get();
    }

    public function buscarCarteiraPagador(int $userId): Collection 
    {
        return $this->model->where('user_id',$userId)->get();
    }

    public function buscarCarteiraRecebedor(int $id): Collection 
    {
        return $this->model->where('id',$id)->get();
    }

    public function atualizar(Collection $dados): Carteira 
    {       
        return $this->model->updateOrCreate(
            ['id' => $dados[0]->id],
            ['saldo' => $dados[0]->saldo, 'valorNegativo' => $dados[0]->valorNegativo]
        );
    }
}