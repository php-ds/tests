<?php
namespace Ds\Tests\Set;

trait _unset
{
    public function testArrayAccessUnset()
    {
        $set = $this->getInstance(['a', 'b', 'c']);
        $this->expectArrayAccessUnsupportedException();
        unset($set[0]);
    }

    public function testArrayAccessUnsetByMethod()
    {
        $set = $this->getInstance();
        $this->expectArrayAccessUnsupportedException();
        $set->offsetUnset('a');
    }
}
