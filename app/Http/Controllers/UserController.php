<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Service\UserService;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    private $service;

    public function __construct(UserService $service) 
    {
        $this->service = $service;
    }

    public function salvar(UserRequest $dados): JsonResponse 
    {                                  
        return $this->service->salvar($dados->all());            
    }
}
