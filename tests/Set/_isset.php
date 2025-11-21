<?php
namespace Ds\Tests\Set;

trait _isset
{
    public function testArrayAccessIsset()
    {
        $set = static::getInstance(['a', 'b', 'c']);
        $this->expectArrayAccessUnsupportedException();
        isset($set[0]);
    }

    public function testArrayAccessIssetByMethod()
    {
        $set = static::getInstance(['a', 'b', 'c']);
        $this->expectArrayAccessUnsupportedException();
        $set->offsetExists(0);
    }
}
