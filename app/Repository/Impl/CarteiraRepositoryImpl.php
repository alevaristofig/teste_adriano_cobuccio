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
}