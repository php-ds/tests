<?php
namespace Ds\Tests\Sequence;

use PHPUnit\Framework\Attributes\DataProvider;

trait toArray
{
    public static function toArrayDataProvider()
    {
        return static::basicDataProvider();
    }


    #[DataProvider('toArrayDataProvider')]
    public function testToArray(array $values, array $expected)
    {
        $instance = $this->getInstance($values);
        $this->assertToArray($expected, $instance);
    }
}
