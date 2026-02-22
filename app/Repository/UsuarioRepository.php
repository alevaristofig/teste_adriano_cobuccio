<?php

namespace App\Repository;

use App\Models\User;

interface UsuarioRepository
{
    public function salvar(array $dados): User;
}