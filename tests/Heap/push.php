<?php
namespace Ds\Tests\Heap;

trait push
{
    public function testPush()
    {
        $heap = $this->getInstance();
        $heap->push(3);
        $heap->push(1);
        $heap->push(5);

        $this->assertCount(3, $heap);
        $this->assertEquals(5, $heap->peek());
    }

    public function testPushVariadic()
    {
        $heap = $this->getInstance();
        $heap->push(3, 1, 5, 2);

        $this->assertCount(4, $heap);
        $this->assertEquals(5, $heap->peek());
    }

    public function testPushMany()
    {
        $heap = $this->getInstance();
        for ($i = 0; $i < self::MANY; $i++) {
            $heap->push($i);
        }
        $this->assertCount(self::MANY, $heap);
        $this->assertEquals(self::MANY - 1, $heap->peek());
    }
}
