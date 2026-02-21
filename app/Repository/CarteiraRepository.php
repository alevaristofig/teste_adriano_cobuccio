<?php

namespace App\Repository;

use App\Http\Requests\DepositoRequest;

interface CarteiraRepository {
    public function depositar(DepositoRequest $request);
}