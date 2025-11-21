<?php
namespace Ds\Tests\Map;

use PHPUnit\Framework\Attributes\DataProvider;

trait ksorted
{
    public static function sortedKeyDataProvider()
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

    #[DataProvider('sortedKeyDataProvider')]
    public function testSortedByKey(array $values)
    {
        $instance = static::getInstance($values);

        $expected = $values;
        ksort($expected);

        $this->assertToArray($expected, $instance->ksorted());
        $this->assertToArray($values, $instance);
    }

    #[DataProvider('sortKeyDataProvider')]
    public function testSortedByKeyUsingComparator(array $values)
    {
        $instance = static::getInstance($values);

        $sorted = $instance->ksorted(function($a, $b) {
            return $b <=> $a;
        });

        $expected = $values;
        krsort($expected);

        $this->assertToArray($expected, $sorted);
        $this->assertToArray($values, $instance);
    }
}
