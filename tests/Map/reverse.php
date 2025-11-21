<?php
namespace Ds\Tests\Map;

use PHPUnit\Framework\Attributes\DataProvider;

trait reverse
{
    public static function reverseDataProvider()
    {
        $reverse = function($a) {
            return [$a[0], array_reverse($a[1], 1)];
        };

        return array_map($reverse, self::basicDataProvider());
    }

    #[DataProvider('reverseDataProvider')]
    public function testReverse(array $values, array $expected)
    {
        $instance = static::getInstance($values);
        $instance->reverse();

        $this->assertToArray($expected, $instance);
    }
}
