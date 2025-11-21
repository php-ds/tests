<?php
namespace Ds\Tests\Stack;

trait _unset
{
    public function testArrayAccessUnset()
    {
        $set = static::getInstance();
        $this->expectArrayAccessUnsupportedException();
        unset($set['a']);
    }
}
