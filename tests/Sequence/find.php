<?php
namespace Ds\Tests\Sequence;

use PHPUnit\Framework\Attributes\DataProvider;

trait find
{
    public static function findDataProvider()
    {
        // initial, value, expected
        return [

            [[], 0, false],

            [['a'], 'a', 0],
            [['a'], 'b', false],

            [['a', 'b'], 'a', 0],
            [['a', 'b'], 'b', 1],
            [['a', 'b'], 'c', false],

            [['a', 'b', 'c'], 'a', 0],
            [['a', 'b', 'c'], 'b', 1],
            [['a', 'b', 'c'], 'c', 2],
            [['a', 'b', 'c'], 'd', false],
        ];
    }

    #[DataProvider('findDataProvider')]
    public function testFind($initial, $value, $expected)
    {
        $instance = static::getInstance($initial);
        $this->assertEquals($expected, $instance->find($value));
    }
}
