<?php

namespace Jithran\GitRibbon\Tests;

use Jithran\GitRibbon\GitRibbonServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            GitRibbonServiceProvider::class,
        ];
    }
}