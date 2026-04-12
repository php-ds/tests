<?php
namespace Ds\Tests\Heap;

trait _serialize
{
    public function testSerialize()
    {
        $heap = $this->getInstance([3, 1, 2]);
        $unserialized = unserialize(serialize($heap));

        $this->assertInstanceOf(\Ds\Heap::class, $unserialized);
        $this->assertCount(3, $unserialized);
        $this->assertEquals(3, $unserialized->peek());
    }

    public function testSerializeEmpty()
    {
        $heap = $this->getInstance([]);
        $unserialized = unserialize(serialize($heap));
        $this->assertCount(0, $unserialized);
    }
}
