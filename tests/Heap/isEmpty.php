<?php
namespace Ds\Tests\Heap;

trait isEmpty
{
    public function testIsEmpty()
    {
        $heap = $this->getInstance();
        $this->assertTrue($heap->isEmpty());

        $heap->push(1);
        $this->assertFalse($heap->isEmpty());

        $heap->pop();
        $this->assertTrue($heap->isEmpty());
    }
}
