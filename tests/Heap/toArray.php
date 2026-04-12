<?php
namespace Ds\Tests\Heap;

trait toArray
{
    public function testToArray()
    {
        $heap = $this->getInstance([3, 1, 2]);
        $array = $heap->toArray();

        // toArray returns values in heap order (descending for max-heap)
        $this->assertEquals([3, 2, 1], $array);
    }

    public function testToArrayEmpty()
    {
        $heap = $this->getInstance();
        $this->assertEquals([], $heap->toArray());
    }
}
