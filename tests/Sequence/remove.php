<?php
namespace Ds\Tests\Sequence;

use PHPUnit\Framework\Attributes\DataProvider;

trait remove
{
    public static function removeDataProvider()
    {
        // initial, index, return, expected
        return [

            [['a'], 0, 'a', []],

            [['a', 'b'], 0, 'a', ['b']],
            [['a', 'b'], 1, 'b', ['a']],

            [['a', 'b', 'c'], 0, 'a', ['b', 'c']],
            [['a', 'b', 'c'], 1, 'b', ['a', 'c']],
            [['a', 'b', 'c'], 2, 'c', ['a', 'b']],
        ];
    }

    #[DataProvider('removeDataProvider')]
    public function testRemove($initial, $index, $return, array $expected)
    {
        $instance = static::getInstance($initial);
        $returned = $instance->remove($index);

        $this->assertEquals(count($initial) - 1, count($instance));
        $this->assertToArray($expected, $instance);
        $this->assertEquals($return, $returned);
    }

    #[DataProvider('outOfRangeDataProvider')]
    public function testRemoveIndexOutOfRange($initial, $index)
    {
        $instance = static::getInstance($initial);
        $this->expectIndexOutOfRangeException();
        $instance->remove($index);
    }

    #[DataProvider('badIndexDataProvider')]
    public function testRemoveIndexBadIndex($initial, $index)
    {
        $instance = static::getInstance($initial);
        $this->expectWrongIndexTypeException();
        $instance->remove($index);
    }
}
