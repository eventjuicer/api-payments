<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->bindRemotes();
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    private function bindRemotes()
    {
        $this->app->bind('App\Services\Remotes\Contracts\MainRemoteRepositoryInterface', 'App\Services\Remotes\MainRemoteRepository');
    }
}
