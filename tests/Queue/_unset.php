<?php
namespace Ds\Tests\Queue;

trait _unset
{
    public function testArrayAccessUnset()
    {
        $set = $this->getInstance();
        $this->expectArrayAccessUnsupportedException();
        unset($set['a']);
    }

    public function testArrayAccessUnsetByMethod()
    {
        $set = $this->getInstance();
        $this->expectArrayAccessUnsupportedException();
        $set->offsetUnset('a');
    }
}
