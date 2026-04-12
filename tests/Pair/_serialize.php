<?php
namespace Ds\Tests\Pair;

trait _serialize
{
    public function testSerialize()
    {
        $pair = $this->getPair('a', 1);
        $unserialized = unserialize(serialize($pair));

        $this->assertInstanceOf(\Ds\Pair::class, $unserialized);
        $this->assertEquals($pair->toArray(), $unserialized->toArray());
        $this->assertTrue($pair !== $unserialized);
    }
}
