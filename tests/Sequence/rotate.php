<?php
namespace Ds\Tests\Sequence;

trait rotate
{
    public function rotateDataProvider()
    {
        // values, rotation, expected
        return [
            [['a', 'b', 'c'],  0, ['a', 'b', 'c']],
            [['a', 'b', 'c'],  1, ['b', 'c', 'a']],
            [['a', 'b', 'c'],  2, ['c', 'a', 'b']],
            [['a', 'b', 'c'],  3, ['a', 'b', 'c']],
            [['a', 'b', 'c'],  4, ['b', 'c', 'a']],

            [['a', 'b', 'c'], -1, ['c', 'a', 'b']],
            [['a', 'b', 'c'], -2, ['b', 'c', 'a']],
            [['a', 'b', 'c'], -3, ['a', 'b', 'c']],
            [['a', 'b', 'c'], -4, ['c', 'a', 'b']],
        ];
    }

    /**
     * @dataProvider rotateDataProvider
     */
    public function testRotate(array $values, int $rotation, array $expected)
    {
        $instance = $this->getInstance($values);
        $instance->rotate($rotation);
        $this->assertToArray($expected, $instance);
    }
}
