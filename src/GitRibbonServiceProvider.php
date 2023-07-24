<?php

namespace Jithran\GitRibbon;

use Illuminate\Support\ServiceProvider;

class GitRibbonServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/git-ribbon.php' => config_path('git-ribbon.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/git-ribbon.php', 'git-ribbon');
    }
}