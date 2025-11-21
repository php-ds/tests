<?php
namespace Ds\Tests\Map;

use PHPUnit\Framework\Attributes\DataProvider;

trait ksort
{
    public static function sortKeyDataProvider()
    {
        return [
            [[

            ]],
            [[
                'a' => 3,
                'c' => 1,
                'b' => 2,
            ]],
            [[
                3 => 'd',
                0 => 'a',
                1 => 'b',
                4 => 'e',
                2 => 'c',
            ]],
        ];
    }

    #[DataProvider('sortKeyDataProvider')]
    public function testSortByKey(array $values)
    {
        $instance = static::getInstance($values);

        $expected = $values;
        ksort($expected);

        $instance->ksort();
        $this->assertToArray($expected, $instance);
    }

    #[DataProvider('sortKeyDataProvider')]
    public function testSortByKeyUsingComparator(array $values)
    {
        $instance = static::getInstance($values);

        $instance->ksort(function($a, $b) {
            return $b <=> $a;
        });

        $expected = $values;
        krsort($expected);

        $this->assertToArray($expected, $instance);
    }
}
