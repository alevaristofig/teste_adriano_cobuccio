<?php

namespace App\Service;

use App\Models\Carteira;
use App\Repository\CarteiraRepository;

class CarteiraService {

    private $repository;

    public function __construct(CarteiraRepository $repository) 
    {
        $this->repository = $repository;
    }

    public function salvar(array $dados): Carteira 
    {
        try {                                
            return $this->repository->salvar($dados);             
        } catch(\Exception $e) {
            throw new Exception($e->getMessage);
        }
    }

     public function buscar(int $id): Carteira | null 
     {
        try {
            return $this->repository->buscar($id);
        } catch(\Exception $e) {
            throw new Exception($e->getMessage);
        }
    }

    public function atualizar(int $id, array $dados): Carteira 
    {
        try {            
            return $this->repository->atualizar($id,$dados);
        } catch(\Exception $e) {
            throw new Exception($e->getMessage);
        }
    }

 /*   public function deletar(int $id): boolean 
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
    }*/
}