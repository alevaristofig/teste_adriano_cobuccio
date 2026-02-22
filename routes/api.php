<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('usuario')->group(function() {
    Route::group([
        'as' => 'usuario',
        //'middleware'=> \Tymon\JWTAuth\Http\Middleware\Authenticate::class
    ], function() {      
       // Route::get('/produto',[ProdutoController::class,'listar']);
        Route::post('/usuario',[UserController::class,'salvar']);
       // Route::put('/produto/{id}',[ProdutoController::class,'atualizar']);
       // Route::get('/produto/{id}',[ProdutoController::class,'buscar']);
       // Route::delete('/produto/{id}',[ProdutoController::class,'deletar']);
    });
});