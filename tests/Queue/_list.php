<?php
namespace Ds\Tests\Queue;

trait _list
{
    public function testList()
    {
        $instance = $this->getInstance(['a', 'b', 'c']);
        $this->expectListNotSupportedException();
        list($a, $b, $c) = $instance;
    }

    public function testListByMethod()
    {
        $instance = $this->getInstance(['a', 'b', 'c']);
        $this->expectListNotSupportedException();
        $instance->offsetGet(0);
    }
}
