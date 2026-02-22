<?php

namespace App\Repository\Impl;

use App\Repository\OperacaoRepository;
use App\Models\Operacao;

class OperacaoRepositoryImpl implements OperacaoRepository
{
    private $model;

    public function __construct(Operacao $operacao) 
    {
        $this->model = $operacao;
    }

    public function depositar(array $dados): Operacao 
    {
       return $this->model->create($dados);
    }
}