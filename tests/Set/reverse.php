<?php
namespace Ds\Tests\Set;

use PHPUnit\Framework\Attributes\DataProvider;

trait reverse
{
    public static function reverseDataProvider()
    {
        return array_map(function($a) { return [$a[0], array_reverse($a[1])]; },
            self::basicDataProvider()
        );
    }

    #[DataProvider('reverseDataProvider')]
    public function testReverse(array $values, array $expected)
    {
        $instance = static::getInstance($values);
        $instance->reverse();

        $this->assertToArray($expected, $instance);
    }
}
