<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Service\OperacaoService;
use App\Http\Requests\OperacaoRequest;

class OperacaoController extends Controller
{
    private $service;

    public function __construct(OperacaoService $service) 
    {
        $this->service = $service;
    }

    public function depositar(OperacaoRequest $dados): JsonResponse 
    {
        return response()->json($this->service->depositar($dados->all()),200);       
    }
}
