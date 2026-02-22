<?php

namespace App\Service;

use App\Models\Carteira;
use App\Http\Requests\CarteiraRequest;

class CarteiraService implements CarteiraRepository {
    private $model;

    public function __construct(Carteira $carteira) 
    {
        $this->model = $carteira;
    }

    public function salvar(CarteiraRequest $request): Carteira 
    {
        try {                                
            return $this->model->create($request->all());             
        } catch(\Exception $e) {
            throw new Exception($e->getMessage);
        }
    }

    public function listar(): Collection 
    {
        try {     
            //pegar id da sessão                   
            return $this->model->all();
        } catch(\Exception $e) {
            throw new Exception($e->getMessage);
        }
    }

     public function buscar(int $id): Carteira | null 
     {
        try {
            return $this->model->find($id);
        } catch(\Exception $e) {
            throw new Exception($e->getMessage);
        }
    }

    public function atualizar(int $id, CarteiraRequest $request): Carteira 
    {
        try {
            $carteira = $this->model->find($id);

            //verificar se tem operações com o numero da carteira
            $carteira->numero = $request->numero; 
            $carteira->titular = $request->titular;  
            $carteira->saldo = $request->saldo;  

            $carteira->save();


            return $carteira;

        } catch(\Exception $e) {
            throw new Exception($e->getMessage);
        }
    }

    public function deletar(int $id): boolean 
    {
        try {
            $carteira = $this->model->find($id);

            $carteira->delete();

            return true;
        } catch(\Exception $e) {
            throw new Exception($e->getMessage);

            //verificar se é possivel
            //return false;
        }
    }

   /* 

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
    }*/
}