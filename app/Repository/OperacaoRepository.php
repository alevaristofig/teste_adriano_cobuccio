<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Operacao;

interface OperacaoRepository 
{
    public function listar(int $id): Collection;
    public function buscar(int $id): Collection;
    public function depositar(array $dados): Operacao;
    public function transferir(array $dados, array $dadosUsuarios): bool;
    public function revisar(array $dados): bool;
}