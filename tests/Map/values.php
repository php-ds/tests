<?php
namespace Ds\Tests\Map;

use PHPUnit\Framework\Attributes\DataProvider;

use Ds\Seq;

trait values
{
    public static function valuesDataProvider()
    {
        return [

            [[], []],

            [['a' => 1, 'b' => 2], [1, 2]],

            [range(0, self::MANY), range(0, self::MANY)],
        ];
    }


    #[DataProvider('valuesDataProvider')]
    public function testValues(array $initial, array $expected)
    {
        $instance = $this->getInstance($initial);
        $values = $instance->values();

        $this->assertInstanceOf(Seq::class, $values);
        $this->assertEquals($expected, $values->toArray());
    }
}
