<?php
namespace Ds\Tests\Queue;

trait _list
{
    public function testList()
    {
        $instance = static::getInstance(['a', 'b', 'c']);
        $this->expectListNotSupportedException();
        list($a, $b, $c) = $instance;
    }

    public function testListByMethod()
    {
        $instance = static::getInstance(['a', 'b', 'c']);
        $this->expectListNotSupportedException();
        $instance->offsetGet(0);
    }
}
