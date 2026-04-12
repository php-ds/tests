<?php
namespace Ds\Tests\Seq;

use PHPUnit\Framework\Attributes\DataProvider;

trait remove
{
    public static function removeDataProvider()
    {
        // initial, index, expected return, expected state
        return [
            [['a', 'b', 'c'], 0, 'a', ['b', 'c']],
            [['a', 'b', 'c'], 1, 'b', ['a', 'c']],
            [['a', 'b', 'c'], 2, 'c', ['a', 'b']],
            [['a'], 0, 'a', []],
        ];
    }


    #[DataProvider('removeDataProvider')]
    public function testRemove(array $initial, int $index, $expectedReturn, array $expectedState)
    {
        $instance = $this->getInstance($initial);
        $returned = $instance->remove($index);

        $this->assertEquals($expectedReturn, $returned);
        $this->assertToArray($expectedState, $instance);
    }


    #[DataProvider('outOfRangeDataProvider')]
    public function testRemoveIndexOutOfRange($initial, $index)
    {
        $instance = $this->getInstance($initial);
        $this->expectIndexOutOfRangeException();
        $instance->remove($index);
    }
}
