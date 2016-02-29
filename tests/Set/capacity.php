<?php
namespace Ds\Tests\Set;

use Ds\Set;

trait capacity
{
    public function testCapacity()
    {
        $min = Set::MIN_CAPACITY;

        $instance = $this->getInstance();
        $this->assertEquals($min, $instance->capacity());

        for ($i = 0; $i < $min; $i++) {
            $instance[] = $i;
        }

        // Should not resize when full after add
        $this->assertEquals($min, $instance->capacity());

        // Should resize when full before add
        $instance[] = $min;
        $this->assertEquals($min * 2, $instance->capacity());
    }

    public function testAutoTruncate()
    {
        $instance = $this->getInstance(range(0, self::MANY - 1));
        $expected = $instance->capacity() / 2;

        for ($i = 0; $i <= 3 * self::MANY / 4; $i++) {
            $instance->remove($i);
        }

        $this->assertEquals($expected, $instance->capacity());
    }

    public function testClearResetsCapacity()
    {
        $instance = $this->getInstance(range(1, self::MANY));
        $instance->clear();
        $this->assertEquals(Set::MIN_CAPACITY, $instance->capacity());
    }
}
