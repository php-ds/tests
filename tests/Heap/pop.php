<?php
namespace Ds\Tests\Heap;

trait pop
{
    public function testPop()
    {
        $heap = $this->getInstance([3, 1, 5, 2]);
        $this->assertEquals(5, $heap->pop());
        $this->assertEquals(3, $heap->pop());
        $this->assertEquals(2, $heap->pop());
        $this->assertEquals(1, $heap->pop());
    }

    public function testPopEmpty()
    {
        $heap = $this->getInstance();
        $this->expectEmptyNotAllowedException();
        $heap->pop();
    }

    public function testPopMaintainsHeapProperty()
    {
        $heap = $this->getInstance(range(1, self::SOME));
        $prev = $heap->pop();

        while (!$heap->isEmpty()) {
            $curr = $heap->pop();
            $this->assertGreaterThanOrEqual($curr, $prev);
            $prev = $curr;
        }
    }
}
