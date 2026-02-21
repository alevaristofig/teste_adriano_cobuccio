<?php

namespace App\Service;

use App\Models\Carteira;

class CarteiraService implements CarteiraRepository {
    private $model;

    public function __construct(Carteira $carteira) {
        $this->model = $carteira;
    }

    public function depositar(DepositoRequest $request): Carteira 
    {
        try {
            return $model->create($request->all());
        } catch(\Exception $e) {
            throw new Exception($e->getMessage);
        }
    }

    public function transferir(CarteiraRequest $request): Carteira 
    {
        try {
            $carteira = $this->buscarSaldo($request->id,$request->numero);

            if($carteira->saldo < 0) {
                //TO DO
                //retiar o valor do deposito e mandar uma mensagem
                $request->valor+= $carteira->saldo;

                //depositar para a carteira que vai redeber o valor
                //retirar da carteira que fez a transferencia;

            }
        } catch(\Exception $e) {
            throw new Exception($e->getMessage);
        }
    }

    private function buscarCarteira(int $id, int $numero): int 
    {
        //pegar os dados da sessao
        return $this->model->where('id',id)->where('numero',numero)->get();
    }
}