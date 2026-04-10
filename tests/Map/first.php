<?php
namespace Ds\Tests\Map;

use PHPUnit\Framework\Attributes\DataProvider;

trait first
{
    public static function firstDataProvider()
    {
        // initial, returned
        return [
            [['a'],             [0, 'a']],
            [['a', 'b'],        [0, 'a']],
            [['a', 'b', 'c'],   [0, 'a']],
        ];
    }


    #[DataProvider('firstDataProvider')]
    public function testFirst(array $initial, $expected)
    {
        $instance = $this->getInstance($initial);
        $first = $instance->first();

        $this->assertEquals($expected, [$first->key, $first->value]);
    }

    public function testFirstNowAllowedWhenEmpty()
    {
        $instance = $this->getInstance();
        $this->expectEmptyNotAllowedException();
        $instance->first();
    }
}
