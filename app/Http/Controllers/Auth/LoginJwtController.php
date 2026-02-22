<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class LoginJwtController extends Controller
{
    public function login(Request $request): JsonResponse {        
        $credentials = $request->all(['email', 'password']);

        Validator::make($credentials, [
            'email' => 'required|string',
            'password' => 'required|string'
        ])->validate();

        if(!$token = auth('api')->attempt($credentials))
        {            
            return response()->json(['error' => "Acesso Negado"], 401); 
        }       

        return response()->json([
            'token' =>$token,
            'id' =>  auth('api')->user()->id                     
        ],200);
    }

    public function logout(): void
    {
        auth('api')->logout();
    }
}
