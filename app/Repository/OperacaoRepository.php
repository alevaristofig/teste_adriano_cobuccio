<?php

namespace App\Repository;

use App\Models\Operacao;

interface OperacaoRepository 
{
    //public function listar(int $carteira_id): Collection;
    public function buscar(int $id): Operacao;
    public function depositar(array $dados): Operacao;
    public function transferir(array $request): bool;
    public function revisar(int $id, string $msg): bool;
}