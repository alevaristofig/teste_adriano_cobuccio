<?php

namespace App\Repository;

use App\Http\Requests\DepositoRequest;
use App\Models\Carteira;

interface CarteiraRepository {
    public function depositar(DepositoRequest $request): Carteira;
}