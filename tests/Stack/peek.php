<?php
namespace Ds\Tests\Stack;

use PHPUnit\Framework\Attributes\DataProvider;

trait peek
{
    public static function peekDataProvider()
    {
        // initial, returned, expected result
        return [
            [['a'],         'a'],
            [['a', 'b'],    'b'],
        ];
    }


    #[DataProvider('peekDataProvider')]
    public function testPeek($initial, $returned)
    {
        $instance = $this->getInstance($initial);

        $value = $instance->peek();

        $this->assertToArray(array_reverse($initial), $instance);
        $this->assertEquals($returned, $value);
    }

    public function testPeekNotAllowedWhenEmpty()
    {
        $instance = $this->getInstance();
        $this->expectEmptyNotAllowedException();
        $instance->peek();
    }
}
