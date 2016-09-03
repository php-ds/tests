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
        // size => capacity
        $boundaries = [
            64 => 128, // Initial capacity for 64 elements would be 128.
            33 => 128,
            32 =>  64,
            31 =>  64,
            17 =>  64,
            16 =>  32,
            15 =>  32,
            9  =>  32,
            8  =>  16,
            7  =>  16,
            5  =>  16,
            4  =>   8,
            3  =>   8,
            0  =>   8,
        ];

        $instance = $this->getInstance(range(1, array_keys($boundaries)[0]));

        for (;;) {
            if ( ! is_null(($expected = $boundaries[$instance->count()] ?? null))) {
                $this->assertEquals($expected, $instance->capacity());
            }

            if ($instance->isEmpty()) {
                break;
            }

            $instance->pop();
        }
    }

    public function testClearResetsCapacity()
    {
        $min = \Ds\Sequence::MIN_CAPACITY;

        $instance = $this->getInstance(range(1, self::MANY));
        $instance->clear();

        $this->assertEquals($min, $instance->capacity());
    }
}
