<?php
namespace Ds\Tests\Stack;

trait _echo
{
    public function testEcho()
    {
        $this->assertInstanceToString(static::getInstance());
    }
}
