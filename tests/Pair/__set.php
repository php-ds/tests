<?php
namespace Ds\Tests\Pair;

trait __set
{
    public function testPropertySetKeyThrows()
    {
        $pair = $this->getPair('a', 1);
        $this->expectException(\Error::class);
        $pair->key = 'b';
    }

    public function testPropertySetValueThrows()
    {
        $pair = $this->getPair('a', 1);
        $this->expectException(\Error::class);
        $pair->value = 2;
    }
}
