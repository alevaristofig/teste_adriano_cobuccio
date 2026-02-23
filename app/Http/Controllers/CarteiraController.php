<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Service\CarteiraService;
use App\Http\Requests\CarteiraRequest;

class CarteiraController extends Controller
{
    private $service;

    public function __construct(CarteiraService $service) 
    {
        $this->service = $service;
    }

    public function buscar(int $id): JsonResponse 
    {
        return response()->json($this->service->buscar($id),200);         
    }

    public function salvar(CarteiraRequest $dados): JsonResponse 
    {
        return response()->json($this->service->salvar($dados->all()),200); 
    }
}
