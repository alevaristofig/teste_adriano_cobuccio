<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginJwtController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CarteiraController;
use App\Http\Controllers\OperacaoController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('carteira')->group(function() {

    Route::post('/autenticacao',[LoginJwtController::class,'login'])->name('login');
    Route::get('/logout',[LoginJwtController::class,'logout'])->name('logout');

    Route::post('/usuarios',[UserController::class,'salvar']);

    Route::group([
        'as' => 'carteira',
        //'middleware'=> \Tymon\JWTAuth\Http\Middleware\Authenticate::class
    ], function() {      
        Route::post('/carteiras',[CarteiraController::class,'salvar']);
        Route::get('/carteiras/{id}',[CarteiraController::class,'buscar']);
       // Route::get('/produto',[ProdutoController::class,'listar']);
        
       // Route::put('/produto/{id}',[ProdutoController::class,'atualizar']);
       // Route::get('/produto/{id}',[ProdutoController::class,'buscar']);
       // Route::delete('/produto/{id}',[ProdutoController::class,'deletar']);
    });

    Route::group([
        'as' => 'operacao',
        'middleware'=> \Tymon\JWTAuth\Http\Middleware\Authenticate::class
    ], function() {      
        Route::post('/operacoes/depositar',[OperacaoController::class,'depositar']);
        Route::post('/operacoes/transferir',[OperacaoController::class,'transferir']);
        Route::get('/operacoes/{id}',[OperacaoController::class,'listar']);
       // Route::get('/produto',[ProdutoController::class,'listar']);
        
       // Route::put('/produto/{id}',[ProdutoController::class,'atualizar']);
       // Route::get('/produto/{id}',[ProdutoController::class,'buscar']);
       // Route::delete('/produto/{id}',[ProdutoController::class,'deletar']);
    });
});