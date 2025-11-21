<?php
namespace Ds\Tests\Stack;

trait _isset
{
    public function testArrayAccessIsset()
    {
        $set = static::getInstance();
        $this->expectArrayAccessUnsupportedException();
        isset($set['a']);
    }
}
