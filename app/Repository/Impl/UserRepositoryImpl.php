<?php

namespace App\Repository\Impl;

use App\Repository\UsuarioRepository;
use App\Models\User;

class UserRepositoryImpl implements UsuarioRepository
{
    private $model;

    public function __construct(User $user) 
    {
        $this->model = $user;
    }

    public function salvar(array $dados): User 
    {                 
        $dados['password'] = bcrypt($dados['password']);     
                             
        return $this->model->create($dados);            
    }
}