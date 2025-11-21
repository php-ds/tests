<?php
namespace Ds\Tests\PriorityQueue;

trait _isset
{
    public function testArrayAccessIsset()
    {
        $instance = static::getInstance();
        $this->expectArrayAccessUnsupportedException();
        isset($instance['?']);
    }
}
