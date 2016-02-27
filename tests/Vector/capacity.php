<?php
namespace Ds\Tests\Vector;

trait capacity
{
    public function testCapacity()
    {
        $min = \Ds\Vector::MIN_CAPACITY;

        $instance = $this->getInstance();
        $this->assertEquals($min, $instance->capacity());

        for ($i = 0; $i < $min; $i++) {
            $instance->push($i);
        }

        // Should not resize when full after push
        $this->assertEquals($min, $instance->capacity());

        // Should resize if full before push
        $instance->push('x');
        $this->assertEquals($min * 1.5, $instance->capacity());
    }

    public function testAutoTruncate()
    {
        $min = \Ds\Vector::MIN_CAPACITY;

        $instance = $this->getInstance(range(1, self::MANY));
        $expected = $instance->capacity() / 2;

        for ($i = 0; $i <= 3 * self::MANY / 4; $i++) {
            $instance->pop();
        }

        $this->assertEquals($expected, $instance->capacity());
    }

    public function testClearResetsCapacity()
    {
        $min = \Ds\Vector::MIN_CAPACITY;

        $instance = $this->getInstance(range(1, self::MANY));
        $instance->clear();
        $this->assertEquals($min, $instance->capacity());
    }
}
