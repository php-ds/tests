<?php
namespace Ds\Tests\Map;

use PHPUnit\Framework\Attributes\DataProvider;

trait last
{
    public static function lastDataProvider()
    {
        // initial, returned
        return [
            [['a'],             [0, 'a']],
            [['a', 'b'],        [1, 'b']],
            [['a', 'b', 'c'],   [2, 'c']],
        ];
    }

    #[DataProvider('lastDataProvider')]
    public function testLast($initial, $expected)
    {
        $instance = static::getInstance($initial);
        $last = $instance->last();

        $this->assertEquals($expected, [$last->key, $last->value]);
    }

    public function testLastNotAllowedWhenEmpty()
    {
        $instance = static::getInstance();
        $this->expectEmptyNotAllowedException();
        $instance->last();
    }
}
