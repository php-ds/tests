<?php
namespace Ds\Tests\Seq;

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
    public function testLast(array $initial, $expected)
    {
        $instance = $this->getInstance($initial);
        $this->assertEquals($expected, $instance->last());
    }

    public function testLastNotAllowedWhenEmpty()
    {
        $instance = $this->getInstance();
        $this->expectEmptyNotAllowedException();
        $instance->last();
    }
}
