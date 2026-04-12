<?php
namespace Ds\Tests\Heap;

trait __construct
{
    public function testConstructEmpty()
    {
        $heap = new \Ds\Heap();
        $this->assertCount(0, $heap);
        $this->assertTrue($heap->isEmpty());
    }

    public function testConstructWithArray()
    {
        $heap = new \Ds\Heap([3, 1, 2]);
        $this->assertCount(3, $heap);
        $this->assertEquals(3, $heap->peek());
    }

    public function testConstructWithComparator()
    {
        // Min-heap
        $heap = new \Ds\Heap([], fn($a, $b) => $b <=> $a);
        $heap->push(3);
        $heap->push(1);
        $heap->push(2);
        $this->assertEquals(1, $heap->peek());
    }

    public function testConstructWithValuesAndComparator()
    {
        // Min-heap with initial values
        $heap = new \Ds\Heap([3, 1, 2], fn($a, $b) => $b <=> $a);
        $this->assertEquals(1, $heap->peek());
    }

    public function testConstructWithIterator()
    {
        $heap = new \Ds\Heap(new \ArrayIterator([3, 1, 2]));
        $this->assertCount(3, $heap);
        $this->assertEquals(3, $heap->peek());
    }
}
