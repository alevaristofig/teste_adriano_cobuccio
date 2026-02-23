<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Carteira;

interface CarteiraRepository {

    public function salvar(array $request): Carteira;
    public function buscar(int $id): Collection;
}