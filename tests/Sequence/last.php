<?php
namespace Ds\Tests\Sequence;

use PHPUnit\Framework\Attributes\DataProvider;

trait last
{
    public static function lastDataProvider()
    {
        // initial, returned
        return [
            [['a'],             'a'],
            [['a', 'b'],        'b'],
            [['a', 'b', 'c'],   'c'],
        ];
    }

    #[DataProvider('lastDataProvider')]
    public function testLast($initial, $expected)
    {
        $instance = static::getInstance($initial);
        $this->assertEquals($expected, $instance->last());
    }

    public function testLastNotAllowedWhenEmpty()
    {
        $instance = static::getInstance();
        $this->expectEmptyNotAllowedException();
        $instance->last();
    }
}
