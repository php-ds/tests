<?php
namespace Ds\Tests\Set;

trait _echo
{
    public function testEcho()
    {
        $this->assertInstanceToString(static::getInstance());
    }
}
