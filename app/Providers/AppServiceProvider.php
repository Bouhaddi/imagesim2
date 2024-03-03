<?php

namespace App\Providers;

use App\Domain\Pages\Contracts\PagesRepositoriesInterface;
use App\Domain\Pages\Repositories\PagesRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PagesRepositoriesInterface::class, PagesRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
