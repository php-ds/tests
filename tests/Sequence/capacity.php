<?php
namespace Ds\Tests\Sequence;

trait capacity
{
    public function testCapacity()
    {
        $min = \Ds\Sequence::MIN_CAPACITY;

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
        $min = \Ds\Sequence::MIN_CAPACITY;
        $num = $min * 16;

        $instance = $this->getInstance(range(1, $num - 1));
        $expected = $num / 2;

        for ($i = 0; $i <= 3 * $num / 4; $i++) {
            $instance->pop();
        }

        $this->assertEquals($expected, $instance->capacity());
    }

    public function testClearResetsCapacity()
    {
        $min = \Ds\Sequence::MIN_CAPACITY;

        $instance = $this->getInstance(range(1, self::MANY));
        $instance->clear();
        $this->assertEquals($min, $instance->capacity());
    }
}
