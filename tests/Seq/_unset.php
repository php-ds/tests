<?php
namespace Ds\Tests\Seq;

trait _unset
{
    public function testArrayAccessUnset()
    {
        $instance = $this->getInstance(['a', 'b', 'c']);
        unset($instance[1]);
        $this->assertToArray(['a', 'c'], $instance);
    }

    public function testArrayAccessUnsetLast()
    {
        $instance = $this->getInstance(['a', 'b', 'c']);
        unset($instance[2]);
        $this->assertToArray(['a', 'b'], $instance);
    }

    public function testArrayAccessUnsetFirst()
    {
        $instance = $this->getInstance(['a', 'b', 'c']);
        unset($instance[0]);
        $this->assertToArray(['b', 'c'], $instance);
    }

    public function testArrayAccessUnsetAll()
    {
        $instance = $this->getInstance(['a', 'b', 'c']);
        unset($instance[2]);
        unset($instance[1]);
        unset($instance[0]);
        $this->assertToArray([], $instance);
    }
}
