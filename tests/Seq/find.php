<?php
namespace Ds\Tests\Seq;

use PHPUnit\Framework\Attributes\DataProvider;

trait find
{
    public static function findDataProvider()
    {
        // initial, value, expected
        return [
            [['a', 'b', 'c'], 'a', 0],
            [['a', 'b', 'c'], 'b', 1],
            [['a', 'b', 'c'], 'c', 2],
            [['a', 'b', 'c'], 'd', false],

            // Strict comparison
            [[1, 2, 3], '1', false],
            [[0],       false, false],
            [[0],       null, false],
            [[''],      null, false],
        ];
    }


    #[DataProvider('findDataProvider')]
    public function testFind(array $initial, $value, $expected)
    {
        $instance = $this->getInstance($initial);
        $this->assertSame($expected, $instance->find($value));
    }

    public function testFindInEmpty()
    {
        $instance = $this->getInstance();
        $this->assertFalse($instance->find('a'));
    }
}
