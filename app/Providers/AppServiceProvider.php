<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repository\UsuarioRepository;
use App\Repository\Impl\UserRepositoryImpl;
use App\Repository\CarteiraRepository;
use App\Repository\Impl\CarteiraRepositoryImpl;
use App\Repository\OperacaoRepository;
use App\Repository\Impl\OperacaoRepositoryImpl;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            UsuarioRepository::class,
            UserRepositoryImpl::class,
            CarteiraRepository::class,
            CarteiraRepositoryImpl::class,
            OperacaoRepository::class,
            OperacaoRepositoryImpl::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
