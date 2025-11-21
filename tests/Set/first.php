<?php
namespace Ds\Tests\Set;

use PHPUnit\Framework\Attributes\DataProvider;

trait first
{
    public static function firstDataProvider()
    {
        // initial, returned
        return [
            [['a'],             'a'],
            [['a', 'b'],        'a'],
            [['a', 'b', 'c'],   'a'],
        ];
    }

    #[DataProvider('firstDataProvider')]
    public function testFirst(array $initial, $expected)
    {
        $instance = static::getInstance($initial);
        $this->assertEquals($expected, $instance->first());
    }

    public function testFirstNowAllowedWhenEmpty()
    {
        $instance = static::getInstance();
        $this->expectEmptyNotAllowedException();
        $instance->first();
    }
}
