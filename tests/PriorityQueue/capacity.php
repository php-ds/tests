<?php
namespace Ds\Tests\PriorityQueue;

use Ds\PriorityQueue;

trait capacity
{
    public function testCapacity()
    {
        $min = PriorityQueue::MIN_CAPACITY;

        $instance = $this->getInstance();
        $this->assertEquals($min, $instance->capacity());

        for ($i = 0; $i < $min; $i++) {
            $instance->push($i, 0);
        }

        // Should not resize when full after push
        $this->assertEquals($min, $instance->capacity());

        // Should resize if full before push
        $instance->push($min, 0);
        $this->assertEquals($min * 2, $instance->capacity());
    }

    public function testAutoTruncate()
    {
        $instance = $this->getInstance(range(1, self::MANY));
        $expected = $instance->capacity() / 2;

        for ($i = 0; $i <= 3 * self::MANY / 4; $i++) {
            $instance->pop();
        }

        $this->assertEquals($expected, $instance->capacity());
    }

    public function testClearResetsCapacity()
    {
        $instance = $this->getInstance(range(1, self::MANY));
        $instance->clear();
        $this->assertEquals(PriorityQueue::MIN_CAPACITY, $instance->capacity());
    }
}
