<?php
namespace Ds\Tests\Seq;

use PHPUnit\Framework\Attributes\DataProvider;

trait merge
{
    public static function mergeDataProvider()
    {
        // A, B, expected
        return [
            [[],          [],       []],
            [[],          ['a'],    ['a']],
            [['a'],       ['a'],    ['a', 'a']],
            [['a'],       ['b'],    ['a', 'b']],
            [['a', 'b'],  [],       ['a', 'b']],
            [['a', 'b'],  ['c'],    ['a', 'b', 'c']],
        ];
    }


    #[DataProvider('mergeDataProvider')]
    public function testMerge(array $initial, array $values, array $expected)
    {
        $instance = $this->getInstance($initial);

        $this->assertToArray($expected, $instance->merge($values));
        $this->assertToArray($initial, $instance);
    }

    public function testMergeWithIterator()
    {
        $instance = $this->getInstance(['a', 'b']);

        $merged = $instance->merge(new \ArrayIterator(['c', 'd']));

        $this->assertToArray(['a', 'b', 'c', 'd'], $merged);
        $this->assertToArray(['a', 'b'], $instance);
    }

    public function testMergeWithSelf()
    {
        $instance = $this->getInstance(['a', 'b']);

        $merged = $instance->merge($instance);

        $this->assertToArray(['a', 'b', 'a', 'b'], $merged);
        $this->assertToArray(['a', 'b'], $instance);
    }
}
