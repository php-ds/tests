<?php
namespace Ds\Tests\Stack;

trait _empty
{
    public function testArrayAccessEmpty()
    {
        $set = static::getInstance();
        $this->expectArrayAccessUnsupportedException();
        empty($set['a']);
    }
}
