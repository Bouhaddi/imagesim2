<?php

namespace App\Providers;

use App\Domain\Posts\Contracts\PostsRepositoryInterface;
use App\Domain\Posts\Repositories\PostsRepository;
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
        // Admin Service Provider for Pages features
        $this->app->bind(PagesRepositoriesInterface::class, PagesRepository::class);

        // Admin Service Provider for Posts features
        $this->app->bind(PostsRepositoryInterface::class, PostsRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
