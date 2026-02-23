<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Carteira;

interface CarteiraRepository {

    public function salvar(array $request): Carteira;
    public function buscar(int $id): Collection | null;
    public function atualizar(int $id, array $request): Carteira;
    //public function deletar(int $id): bool;
}