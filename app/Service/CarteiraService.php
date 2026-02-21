<?php

namespace App\Service;

use App\Models\Carteira;

class CarteiraService implements CarteiraRepository {
    private $model;

    public function __construct(Carteira $carteira) {
        $this->model = $carteira;
    }
}