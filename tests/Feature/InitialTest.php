<?php

namespace Jithran\GitRibbon\Tests\Feature;

use Illuminate\Support\Collection;
use Jithran\GitRibbon\Services\GitRibbonService;
use Jithran\GitRibbon\Tests\TestCase;

class InitialTest extends TestCase
{
    /**
     * Test the environment config.
     * @return void
     */
    public function testEnvDefault()
    {
        $env = new Collection(config('git-ribbon.environment'));
        $this->assertTrue($env->contains('local'));
        $this->assertFalse($env->contains('production'));
    }

    public function testEnabled() {
        $gitRibbonService = new GitRibbonService();
        $enabled = $gitRibbonService->isEnabled();
        $this->assertTrue($enabled);
    }
}