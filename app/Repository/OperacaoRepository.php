<?php

namespace App\Repository;

use App\Http\Requests\OperacaoRequest;
use App\Models\Operacao;

interface OperacaoRepository 
{
    public function depositar(OperacaoRequest $request): Operacao;
}