<?php
namespace Ds\Tests\Map;

use PHPUnit\Framework\Attributes\DataProvider;

trait reversed
{
    public static function reversedDataProvider()
    {
        $reverse = function($a) {
            return [$a[0], array_reverse($a[1], 1)];
        };

        return array_map($reverse, self::basicDataProvider());
    }

    #[DataProvider('reversedDataProvider')]
    public function testReversed(array $values, array $expected)
    {
        $instance = static::getInstance($values);
        $this->assertToArray($expected, $instance->reversed());
    }
}
