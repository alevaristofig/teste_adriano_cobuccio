<?php

namespace App\Service;

use App\Repository\UsuarioRepository;
use App\Models\User;

class UserService
{
    private $repositorio;

    public function __construct(UsuarioRepository $repositorio) 
    {
        $this->repositorio = $repositorio;
    }

    public function salvar(array $dados): User 
    {                                  
        return $this->repositorio->salvar($dados);            
    }
}