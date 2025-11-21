<?php
namespace Ds\Tests\Queue;

trait _empty
{
    public function testArrayAccessEmpty()
    {
        $set = static::getInstance();
        $this->expectArrayAccessUnsupportedException();
        empty($set['a']);
    }
}
