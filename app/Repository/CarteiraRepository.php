<?php

namespace App\Repository;

use App\Http\Requests\CarteiraRequest;
use App\Models\Carteira;

interface CarteiraRepository {
    /*public function depositar(CarteiraRequest $request): Carteira;
    public function transferir(CarteiraRequest $request): Carteira;
    public function constestar(CarteiraRequest $request): String;*/

    public function salvar(CarteiraRequest $request);
    public function listar(): Collection;
    public function buscar(int $id): Carteira | null;
    public function atualizar(int $id, CarteiraRequest $request): Carteira | null;
    public function deletar(int $id): void;
}