<?php
namespace Ds\Tests\Sequence;

use PHPUnit\Framework\Attributes\DataProvider;

trait reversed
{
    public static function reversedDataProvider()
    {
        return array_map(function($a) { return [$a[0], array_reverse($a[1])]; },
            self::basicDataProvider()
        );
    }

    #[DataProvider('reversedDataProvider')]
    public function testReversed(array $values, array $expected)
    {
        $instance = static::getInstance($values);
        $this->assertToArray($expected, $instance->reversed());
        $this->assertToArray($values, $instance);
    }
}
