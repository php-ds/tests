<?php
namespace Ds\Tests\Heap;

trait allocate
{
    public function testAllocate()
    {
        $heap = $this->getInstance();
        $heap->allocate(100);
        $this->assertGreaterThanOrEqual(100, $heap->capacity());
        $this->assertCount(0, $heap);
    }
}
