<?php

namespace Jithran\GitRibbon;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;

class GitRibbonServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/git-ribbon.php', 'git-ribbon');
    }


    /**
     * Bootstrap the application services.
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/git-ribbon.php' => config_path('git-ribbon.php'),
        ], 'config');

        $this->registerMiddleware(\Jithran\GitRibbon\Middleware\GitRibbon::class);
    }



    /**
     * Register Middleware
     *
     * @param string $middleware
     */
    protected function registerMiddleware(string $middleware): void
    {
        $kernel = $this->app[Kernel::class];
        $kernel->pushMiddleware($middleware);
    }
}