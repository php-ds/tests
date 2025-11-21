<?php
namespace Ds\Tests\Map;

use PHPUnit\Framework\Attributes\DataProvider;

trait sort
{
    public static function sortDataProvider()
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

    #[DataProvider('sortDataProvider')]
    public function testSort(array $values)
    {
        $instance = static::getInstance($values);

        $expected = array_slice($values, 0, count($values), true);
        asort($expected);

        $instance->sort();
        $this->assertToArray($expected, $instance);
    }

    #[DataProvider('sortDataProvider')]
    public function testSortUsingComparator(array $values)
    {
        $instance = static::getInstance($values);

        $expected = array_slice($values, 0, count($values), true);
        arsort($expected);

        $instance->sort(function($a, $b) {
            return $b <=> $a;
        });

        $this->assertToArray($expected, $instance);
    }
}
