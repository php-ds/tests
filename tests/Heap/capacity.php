<?php
namespace Ds\Tests\Heap;

trait capacity
{
    public function testCapacity()
    {
        $heap = $this->getInstance();
        $this->assertEquals(8, $heap->capacity());
    }

    public function testCapacityGrowsAfterPush()
    {
        $heap = $this->getInstance();
        for ($i = 0; $i < 9; $i++) {
            $heap->push($i);
        }
        $this->assertGreaterThanOrEqual(9, $heap->capacity());
    }
}
