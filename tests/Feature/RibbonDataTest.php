<?php

namespace Jithran\GitRibbon\Tests\Feature;

use Jithran\GitRibbon\RibbonData;
use PHPUnit\Framework\TestCase;

class RibbonDataTest extends TestCase
{

    public function testSetRibbonDataTest()
    {
        $ribbon = new RibbonData('failed','test', 'red', 'tooltip');
        $this->assertEquals('failed', $ribbon->getName());
        $this->assertEquals('test', $ribbon->getLabel());
        $this->assertEquals('red', $ribbon->getBgColor());
        $this->assertEquals('tooltip', $ribbon->getTooltipInfo());

        $ribbon->setName('success');
        $ribbon->setLabel('test2');
        $ribbon->setBgColor('blue');
        $ribbon->setTooltipInfo('tooltip2');
        $this->assertEquals('success', $ribbon->getName());
        $this->assertEquals('test2', $ribbon->getLabel());
        $this->assertEquals('blue', $ribbon->getBgColor());
        $this->assertEquals('tooltip2', $ribbon->getTooltipInfo());

        $this->expectException(\Exception::class);
        $ribbon->setPreset('notfound');
    }
}
