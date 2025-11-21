<?php
namespace Ds\Tests\Sequence;

use PHPUnit\Framework\Attributes\DataProvider;

trait toArray
{
    public static function toArrayDataProvider()
    {
        return self::basicDataProvider();
    }

    #[DataProvider('toArrayDataProvider')]
    public function testToArray(array $values, array $expected)
    {
        $instance = static::getInstance($values);
        $this->assertToArray($expected, $instance);
    }
}
