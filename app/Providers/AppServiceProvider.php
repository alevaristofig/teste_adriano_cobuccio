<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
