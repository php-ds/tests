<?php
namespace Ds\Tests\Heap;

trait peek
{
    public function testPeek()
    {
        $heap = $this->getInstance([3, 1, 5, 2]);
        $this->assertEquals(5, $heap->peek());
        $this->assertCount(4, $heap); // peek doesn't remove
    }

    public function testPeekEmpty()
    {
        $heap = $this->getInstance();
        $this->expectEmptyNotAllowedException();
        $heap->peek();
    }
}
