<?php
namespace Ds\Tests\PriorityQueue;

trait _echo
{
    public function testEcho()
    {
        $this->assertInstanceToString(static::getInstance());
    }
}
