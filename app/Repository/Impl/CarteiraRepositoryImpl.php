<?php

namespace App\Repository\Impl;

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

    public function buscar(int $id): Carteira | null 
    {
        return $this->model->find($id);
    }

    public function atualizar(int $id, array $dados): Carteira 
    {
        $carteira = $this->model->find($id);

        //verificar se tem operações com o numero da carteira
        $carteira->numero = $dados->numero; 
        $carteira->titular = $dados->titular;  
        $carteira->saldo = $dados->saldo;  

        $carteira->save();

        return $carteira;
    }
}