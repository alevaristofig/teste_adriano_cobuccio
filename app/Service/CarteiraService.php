<?php

namespace App\Service;

use App\Models\Carteira;

class CarteiraService implements CarteiraRepository {
    private $model;

    public function __construct(Carteira $carteira) {
        $this->model = $carteira;
    }

    public function depositar(DepositoRequest $request): Carteira {
        try {
            return $model->create($request->all());
        } catch(\Exception $e) {
            throw new Exception($e->getMessage);
        }
    }
}