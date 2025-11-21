<?php
namespace Ds\Tests\Map;

use PHPUnit\Framework\Attributes\DataProvider;

use Ds\Vector;

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
        $instance = static::getInstance($initial);
        $values = $instance->values();

        $this->assertInstanceOf(Vector::class, $values);
        $this->assertEquals($expected, $values->toArray());
    }
}
