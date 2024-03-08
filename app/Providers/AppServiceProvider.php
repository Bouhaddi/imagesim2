<?php

namespace App\Providers;

use App\Domain\Posts\Contracts\PostsRepositoryInterface;
use App\Domain\Posts\Repositories\PostsRepository;
use App\Domain\Pages\Contracts\PagesRepositoriesInterface;
use App\Domain\Pages\Repositories\PagesRepository;
use App\Domain\Sections\Contracts\SectionsRepositoryInterface;
use App\Domain\Sections\Repositories\SectionsRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Admin Service Provider for Pages feature
        $this->app->bind(PagesRepositoriesInterface::class, PagesRepository::class);

        // Admin Service Provider for Posts feature
        $this->app->bind(PostsRepositoryInterface::class, PostsRepository::class);

        // Admin Service Provider for Sections feature
        $this->app->bind(SectionsRepositoryInterface::class, SectionsRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
