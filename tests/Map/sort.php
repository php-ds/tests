<?php
namespace Ds\Tests\Map;

trait sort
{
    public function sortDataProvider()
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

    /**
     * @dataProvider sortDataProvider
     */
    public function testSort(array $values)
    {
        $instance = $this->getInstance($values);

        $expected = array_slice($values, 0, count($values), true);
        asort($expected);

        $instance->sort();
        $this->assertToArray($expected, $instance);
    }

    /**
     * @dataProvider sortDataProvider
     */
    public function testSortUsingComparator(array $values)
    {
        $instance = $this->getInstance($values);

        $expected = array_slice($values, 0, count($values), true);
        arsort($expected);

        $instance->sort(function($a, $b) {
            return $a === $b ? 0 : ($a < $b ? 1 : -1);
        });

        $this->assertToArray($expected, $instance);
    }
}
