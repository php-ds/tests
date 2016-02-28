<?php
namespace Ds\Tests\Pair;

trait __set
{
    public function testPropertySetKey()
    {
        $pair = $this->getPair('a', 1);
        $pair->key = 'b';
        $this->assertEquals('b', $pair->key);
    }

    public function testPropertySetValue()
    {
        $pair = $this->getPair('a', 1);
        $pair->value = 2;
        $this->assertEquals(2, $pair->value);
    }
}
