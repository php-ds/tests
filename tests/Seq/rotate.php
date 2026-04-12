<?php
namespace Ds\Tests\Seq;

use PHPUnit\Framework\Attributes\DataProvider;

trait rotate
{
    public static function rotateDataProvider()
    {
        // initial, rotations, expected
        return [
            // Positive (left rotation)
            [['a', 'b', 'c'],  1, ['b', 'c', 'a']],
            [['a', 'b', 'c'],  2, ['c', 'a', 'b']],
            [['a', 'b', 'c'],  3, ['a', 'b', 'c']],

            // Negative (right rotation)
            [['a', 'b', 'c'], -1, ['c', 'a', 'b']],
            [['a', 'b', 'c'], -2, ['b', 'c', 'a']],
            [['a', 'b', 'c'], -3, ['a', 'b', 'c']],

            // Zero rotation
            [['a', 'b', 'c'],  0, ['a', 'b', 'c']],

            // Empty
            [[],  1, []],

            // Single
            [['a'],  1, ['a']],
        ];
    }


    #[DataProvider('rotateDataProvider')]
    public function testRotate(array $initial, int $rotations, array $expected)
    {
        $instance = $this->getInstance($initial);
        $instance->rotate($rotations);
        $this->assertToArray($expected, $instance);
    }
}
