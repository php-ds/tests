<?php
namespace Ds\Tests\Heap;

trait clear
{
    public function testClear()
    {
        $heap = $this->getInstance([3, 1, 2]);
        $heap->clear();
        $this->assertCount(0, $heap);
        $this->assertTrue($heap->isEmpty());
        $this->assertEquals(8, $heap->capacity());
    }

    public function testClearEmpty()
    {
        $heap = $this->getInstance();
        $heap->clear();
        $this->assertCount(0, $heap);
    }
}
