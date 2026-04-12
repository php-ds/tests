<?php
namespace Ds\Tests\Seq;

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
        $instance = $this->getInstance($initial);
        $this->assertEquals($expected, $instance->first());
    }

    public function testFirstNotAllowedWhenEmpty()
    {
        $instance = $this->getInstance();
        $this->expectEmptyNotAllowedException();
        $instance->first();
    }
}
