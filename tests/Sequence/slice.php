<?php
namespace Ds\Tests\Sequence;

trait slice
{
    public function sliceDataProvider()
    {
        $a = ['a', 'b', 'c'];
        $n = count($a);

        $data = [];

        for ($i = -$n; $i <= $n; $i++) {
            for ($j = -$n; $j <= $n; $j++) {
                $data[] = [[], $i, $j];
                $data[] = [$a, $i, $j];
            }
        }

        return $data;
    }


    /**
     * @dataProvider sliceDataProvider
     */
    public function testSlice(array $values, int $index, int $length)
    {
        $instance = $this->getInstance($values);

        $sliced = $instance->slice($index, $length);
        $expected = array_slice($values, $index, $length);

        $this->assertToArray($values, $instance);
        $this->assertToArray($expected, $sliced);
    }

    /**
     * @dataProvider sliceDataProvider
     */
    public function testSliceWithoutLength(array $values, int $index, int $length)
    {
        $instance = $this->getInstance($values);

        $sliced = $instance->slice($index);
        $expected = array_slice($values, $index);

        $this->assertToArray($values, $instance);
        $this->assertToArray($expected, $sliced);
    }

    public function testLargeSliceHalf()
    {
        $n = self::MANY;
        $x = 0;
        $y = $n / 2;

        $instance = $this->getInstance(range(0, $n));

        $this->assertToArray(range($x, $y - 1), $instance->slice($x, $y));
        $this->assertToArray(range($y, $n),     $instance->slice($y));
    }

    public function testLargeSliceOffset()
    {
        $n = self::MANY;
        $x = $n / 4;
        $y = $n / 4 + $n / 2;

        $instance = $this->getInstance(range(0, $n));

        $this->assertToArray(range($x, $y - 1), $instance->slice($x, $y - $x));
    }

    /**
     * Sequence has a few edge cases that don't exist for other sequences. These
     * occur when the head of the sequence wraps around, ie. h > t.
     */
    public function testSliceExtended()
    {
        $instance = $this->getInstance();

        $instance->unshift('c'); // [_, _, _, _, _, _, _, c] tail = 0, head = 7
        $instance->unshift('b'); // [_, _, _, _, _, _, b, c] tail = 0, head = 6
        $instance->unshift('a'); // [_, _, _, _, _, a, b, c] tail = 0, head = 5

        $this->assertToArray(['a'], $instance->slice(0, 1));
        $this->assertToArray(['b'], $instance->slice(1, 1));
        $this->assertToArray(['c'], $instance->slice(2, 1));

        $this->assertToArray(['a', 'b'], $instance->slice(0, 2));
        $this->assertToArray(['b', 'c'], $instance->slice(1, 2));
        $this->assertToArray(['c'     ], $instance->slice(2, 2));

        $this->assertToArray(['a', 'b', 'c'], $instance->slice(0, 3));
        $this->assertToArray(['b', 'c'     ], $instance->slice(1, 3));
        $this->assertToArray(['c'          ], $instance->slice(2, 3));

        /* If only some values have wrapped around, slice would have to copy
           from both the wrapped and not-wrapped values */

        $instance = $this->getInstance();

        $instance->push('b');    // [b, _, _, _, _, _, _, _] tail = 1, head = 0
        $instance->push('c');    // [b, c, _, _, _, _, _, _] tail = 2, head = 1
        $instance->unshift('a'); // [b, c, _, _, _, _, _, a] tail = 2, head = 7

        $this->assertToArray(['a'], $instance->slice(0, 1));
        $this->assertToArray(['b'], $instance->slice(1, 1));
        $this->assertToArray(['c'], $instance->slice(2, 1));

        $this->assertToArray(['a', 'b'], $instance->slice(0, 2));
        $this->assertToArray(['b', 'c'], $instance->slice(1, 2));
        $this->assertToArray(['c'     ], $instance->slice(2, 2));

        $this->assertToArray(['a', 'b', 'c'], $instance->slice(0, 3));
        $this->assertToArray(['b', 'c'     ], $instance->slice(1, 3));
        $this->assertToArray(['c'          ], $instance->slice(2, 3));
    }
}
