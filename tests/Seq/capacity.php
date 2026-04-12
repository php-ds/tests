<?php
namespace Ds\Tests\Seq;

trait capacity
{
    public function testCapacity()
    {
        $instance = $this->getInstance();
        $this->assertEquals(8, $instance->capacity());
    }

    public function testCapacityAfterPush()
    {
        $instance = $this->getInstance();
        for ($i = 0; $i < 9; $i++) {
            $instance->push($i);
        }
        $this->assertGreaterThanOrEqual(9, $instance->capacity());
    }

    public function testCapacityTruncatesOnClear()
    {
        $instance = $this->getInstance(range(1, 100));
        $instance->clear();
        $this->assertEquals(8, $instance->capacity());
    }
}
