<?php
namespace Ds\Tests\Heap;

trait _clone
{
    public function testClone()
    {
        $instance = $this->getInstance([3, 1, 2]);
        $clone = clone $instance;

        $this->assertEquals(get_class($instance), get_class($clone));
        $this->assertFalse($clone === $instance);
        $this->assertCount(count($instance), $clone);

        // Modifying clone doesn't affect original
        $clone->pop();
        $this->assertCount(3, $instance);
        $this->assertCount(2, $clone);
    }
}
