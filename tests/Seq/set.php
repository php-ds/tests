<?php
namespace Ds\Tests\Seq;

use PHPUnit\Framework\Attributes\DataProvider;

trait set
{
    public static function setDataProvider()
    {
        // initial, index, value, expected
        return [
            [['a', 'b', 'c'], 0, 'x', ['x', 'b', 'c']],
            [['a', 'b', 'c'], 1, 'x', ['a', 'x', 'c']],
            [['a', 'b', 'c'], 2, 'x', ['a', 'b', 'x']],
        ];
    }


    #[DataProvider('setDataProvider')]
    public function testSet(array $initial, int $index, $value, array $expected)
    {
        $instance = $this->getInstance($initial);
        $instance->set($index, $value);
        $this->assertToArray($expected, $instance);
    }


    #[DataProvider('outOfRangeDataProvider')]
    public function testSetIndexOutOfRange($initial, $index)
    {
        $instance = $this->getInstance($initial);
        $this->expectIndexOutOfRangeException();
        $instance->set($index, 'x');
    }


    #[DataProvider('setDataProvider')]
    public function testArrayAccessSet(array $initial, int $index, $value, array $expected)
    {
        $instance = $this->getInstance($initial);
        $instance[$index] = $value;
        $this->assertToArray($expected, $instance);
    }


    #[DataProvider('setDataProvider')]
    public function testArrayAccessSetByMethod(array $initial, int $index, $value, array $expected)
    {
        $instance = $this->getInstance($initial);
        $instance->offsetSet($index, $value);
        $this->assertToArray($expected, $instance);
    }


    #[DataProvider('badIndexDataProvider')]
    public function testSetBadIndex($initial, $index)
    {
        $instance = $this->getInstance($initial);
        $this->expectWrongIndexTypeException();
        $instance->set($index, 'x');
    }
}
