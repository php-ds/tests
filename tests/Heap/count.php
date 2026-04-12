<?php
namespace Ds\Tests\Heap;

trait count
{
    public function testCount()
    {
        $heap = $this->getInstance();
        $this->assertCount(0, $heap);

        $heap->push(1);
        $this->assertCount(1, $heap);

        $heap->push(2);
        $this->assertCount(2, $heap);

        $heap->pop();
        $this->assertCount(1, $heap);
    }
}
