<?php
namespace Ds\Tests\Seq;

use PHPUnit\Framework\Attributes\DataProvider;

trait insert
{
    public static function insertDataProvider()
    {
        // initial, index, values, expected
        return [
            // Insert at the beginning
            [['b', 'c'], 0, ['a'], ['a', 'b', 'c']],

            // Insert in the middle
            [['a', 'c'], 1, ['b'], ['a', 'b', 'c']],

            // Insert at the end
            [['a', 'b'], 2, ['c'], ['a', 'b', 'c']],

            // Insert into empty at index 0
            [[], 0, ['a'], ['a']],

            // Insert variadic
            [['a', 'd'], 1, ['b', 'c'], ['a', 'b', 'c', 'd']],
        ];
    }


    #[DataProvider('insertDataProvider')]
    public function testInsert(array $initial, int $index, array $values, array $expected)
    {
        $instance = $this->getInstance($initial);
        $instance->insert($index, ...$values);
        $this->assertToArray($expected, $instance);
    }


    #[DataProvider('outOfRangeDataProvider')]
    public function testInsertIndexOutOfRange($initial, $index)
    {
        $instance = $this->getInstance($initial);
        $this->expectIndexOutOfRangeException();
        $instance->insert($index, 'x');
    }

    public function testInsertAtBoundary()
    {
        $instance = $this->getInstance(['a', 'b', 'c']);
        $instance->insert(3, 'd');
        $this->assertToArray(['a', 'b', 'c', 'd'], $instance);
    }
}
