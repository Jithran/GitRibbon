<?php

namespace Jithran\GitRibbon\Tests\Feature;

use Jithran\GitRibbon\Tests\TestCase;

class InitialTest extends TestCase
{
    /**
     * Test the environment config.
     * @return void
     */
    public function testEnvDefault()
    {
        $this->assertTrue(config('git-ribbon.environment') === ['local']);
    }
}