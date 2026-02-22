<?php

namespace App\Repository;

use App\Models\Carteira;

interface CarteiraRepository {

    public function salvar(array $request): Carteira;
    public function buscar(int $id): Carteira | null;
    public function atualizar(int $id, array $request): Carteira;
    public function deletar(int $id): bool;
}