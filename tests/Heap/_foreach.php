<?php
namespace Ds\Tests\Heap;

trait _foreach
{
    public function testForEachYieldsInHeapOrder()
    {
        $heap = $this->getInstance([3, 1, 4, 1, 5]);
        $values = [];
        foreach ($heap as $value) {
            $values[] = $value;
        }
        // Max-heap: descending order
        $this->assertEquals([5, 4, 3, 1, 1], $values);
    }

    public function testForEachEmpty()
    {
        $heap = $this->getInstance([]);
        $values = [];
        foreach ($heap as $value) {
            $values[] = $value;
        }
        $this->assertEquals([], $values);
    }

    public function testForEachIsDestructiveOnClone()
    {
        $heap = $this->getInstance([3, 1, 2]);
        foreach ($heap as $value) {
            // just iterate
        }
        // Original heap should still have all values
        $this->assertCount(3, $heap);
    }
}
