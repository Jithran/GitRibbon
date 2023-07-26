<?php

namespace Jithran\GitRibbon;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use Jithran\GitRibbon\Middleware\GitRibbon;

class GitRibbonServiceProvider extends ServiceProvider
{
    private string $name = 'git-ribbon';

    public static function basePath(string $path): string
    {
        return __DIR__ . '/..' . $path;
    }

    /**
     * Register the application services.
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/' . $this->name . '.php', $this->name);
    }


    /**
     * Bootstrap the application services.
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/git-ribbon.php' => config_path($this->name . '.php'),
        ], 'config');

        $this->registerMiddleware();
        $this->registerResources();
    }


    /**
     * Register Middleware
     */
    protected function registerMiddleware(): void
    {
        $kernel = $this->app[Kernel::class];
        $kernel->pushMiddleware(GitRibbon::class);
    }

    protected function registerResources(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', $this->name);
    }

}