<?php

namespace Jithran\GitRibbon\Tests;

use Jithran\GitRibbon\GitRibbonServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('app.debug', true);
    }

    protected function getPackageProviders($app): array
    {
        return [
            GitRibbonServiceProvider::class,
        ];
    }
}