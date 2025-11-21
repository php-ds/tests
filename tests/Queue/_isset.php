<?php
namespace Ds\Tests\Queue;

trait _isset
{
    public function testArrayAccessIsset()
    {
        $set = static::getInstance();
        $this->expectArrayAccessUnsupportedException();
        isset($set['a']);
    }

    public function testArrayAccessIssetByMethod()
    {
        $set = static::getInstance();
        $this->expectArrayAccessUnsupportedException();
        $set->offsetExists('a');
    }
}
