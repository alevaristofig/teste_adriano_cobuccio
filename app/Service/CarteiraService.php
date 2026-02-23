<?php

namespace App\Service;

use Illuminate\Database\Eloquent\Collection;
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
            dd($e->getMessage());
            throw new \RuntimeException('Erro ao cadastrar a carteira');   
        }
    }

     public function buscar(int $id): Collection | null 
     {
        try {
            return $this->repository->buscar($id);
        } catch(\Exception $e) {
             throw new \RuntimeException('Erro ao processa a revisão');   
        }
    }

    public function atualizar(int $id, array $dados): Carteira 
    {
        try {            
            return $this->repository->atualizar($id,$dados);
        } catch(\Exception $e) {
             throw new \RuntimeException('Erro ao processa a revisão');   
        }
    }
}