<?php
namespace Ds\Tests\Seq;

trait allocate
{
    public function testAllocate()
    {
        $instance = $this->getInstance();
        $instance->allocate(100);
        $this->assertGreaterThanOrEqual(100, $instance->capacity());
        $this->assertCount(0, $instance);
    }

    public function testAllocatePreservesValues()
    {
        $instance = $this->getInstance(range(1, 5));
        $instance->allocate(100);
        $this->assertToArray(range(1, 5), $instance);
    }
}
