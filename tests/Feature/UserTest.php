<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Mockery;

use App\Models\User;

class UserTest extends TestCase
{
    public function test_salvarSucesso(): void
    {
        $dados = [
            'name' => "Alexandre",
            'email' => "alevaristofig@gmail.com",
            'password' => "12345",            
        ];

        $mock = Mockery::mock(UsuarioRepository::class);

        $mock->shouldReceive('salvar')
                ->once()
                ->with($dados)
                ->andReturn(new User($dados));

        $this->app->instance(UsuarioRepository::class, $mock);

        $service = app(UsuarioService::class);

        $result = $service->salvar($dados);

        $this->assertEquals("Alexandre",$result->name);
        $this->assertEquals("alevaristofig@gmail.com",$result->email);
    }
}
