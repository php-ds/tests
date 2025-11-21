<?php
namespace Ds\Tests\PriorityQueue;

trait _unset
{
    public function testArrayAccessUnset()
    {
        $instance = static::getInstance();
        $this->expectArrayAccessUnsupportedException();
        unset($instance['?']);
    }
}
