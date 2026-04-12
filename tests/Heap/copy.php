<?php
namespace Ds\Tests\Heap;

trait copy
{
    public function testCopy()
    {
        $heap = $this->getInstance([3, 1, 2]);
        $copy = $heap->copy();

        $this->assertInstanceOf(\Ds\Heap::class, $copy);
        $this->assertFalse($copy === $heap);
        $this->assertCount(3, $copy);

        $copy->pop();
        $this->assertCount(3, $heap);
        $this->assertCount(2, $copy);
    }

    public function testCopyEmpty()
    {
        $heap = $this->getInstance();
        $copy = $heap->copy();
        $this->assertCount(0, $copy);
    }
}
