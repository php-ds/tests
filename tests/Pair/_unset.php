<?php
namespace Ds\Tests\Pair;

trait _unset
{
    public function testPropertyUnsetKeyThrows()
    {
        $pair = $this->getPair('a', 1);
        $this->expectException(\Error::class);
        unset($pair->key);
    }

    public function testPropertyUnsetValueThrows()
    {
        $pair = $this->getPair('a', 1);
        $this->expectException(\Error::class);
        unset($pair->value);
    }
}
