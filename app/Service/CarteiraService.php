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
            throw new \RuntimeException('Erro ao cadastrar a carteira');   
        }
    }

    public function buscar(int $id): Collection | null 
    {
        return $this->repository->buscar($id);
    }

    public function atualizar(Collection $dados): Carteira 
    {
        try {            
            return $this->repository->atualizar($dados);
        } catch(\Exception $e) {
            dd($e->getMessage());
             throw new \RuntimeException('Erro ao atualizar a carteira');   
        }
    }

    public function buscarCarteiraPagador(int $id): Collection 
    {
        return $this->repository->buscarCarteiraPagador($id);      
    }

    public function buscarCarteiraRecebedor(int $id): Collection 
    {
        return $this->repository->buscarCarteiraRecebedor($id);            
    }
}