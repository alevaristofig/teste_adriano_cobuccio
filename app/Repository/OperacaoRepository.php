<?php

namespace App\Repository;

use App\Models\Operacao;

interface OperacaoRepository 
{
    public function depositar(array $dados): Operacao;
    public function transferir(array $request): bool;
}