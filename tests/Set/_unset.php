<?php
namespace Ds\Tests\Set;

trait _unset
{
    public function testArrayAccessUnset()
    {
        $set = static::getInstance(['a', 'b', 'c']);
        $this->expectArrayAccessUnsupportedException();
        unset($set[0]);
    }

    public function testArrayAccessUnsetByMethod()
    {
        $set = static::getInstance();
        $this->expectArrayAccessUnsupportedException();
        $set->offsetUnset('a');
    }
}
