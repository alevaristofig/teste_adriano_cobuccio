<?php

namespace App\Repository;

use App\Http\Requests\DepositoRequest;
use App\Models\Carteira;

interface CarteiraRepository {
    public function depositar(CarteiraRequest $request): Carteira;
    public function transferir(CarteiraRequest $request): Carteira;
    public function constestar(CarteiraRequest $request): String;
}