<?php
namespace Ds\Tests\Deque;

trait capacity
{
    public function testCapacity()
    {
        $min = \Ds\Deque::MIN_CAPACITY;

        $instance = $this->getInstance();
        $this->assertEquals($min, $instance->capacity());

        for ($i = 0; $i < $min; $i++) {
            $instance->push($i);
        }

        // Should resize when full after push
        $this->assertEquals($min * 2, $instance->capacity());
    }

    public function testAutoTruncate()
    {
        $min = \Ds\Deque::MIN_CAPACITY;

        $instance = $this->getInstance(range(1, self::MANY));
        $expected = $instance->capacity() / 4;

        for ($i = 0; $i <= 3 * self::MANY / 4; $i++) {
            $instance->pop();
        }

        $this->assertEquals($expected, $instance->capacity());
    }

    public function testClearResetsCapacity()
    {
        $min = \Ds\Deque::MIN_CAPACITY;

        $instance = $this->getInstance(range(1, self::MANY));
        $instance->clear();
        $this->assertEquals($min, $instance->capacity());
    }
}
