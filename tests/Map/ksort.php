<?php
namespace Ds\Tests\Map;

trait ksort
{
    public function sortKeyDataProvider()
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
     * @dataProvider sortKeyDataProvider
     */
    public function testSortByKey(array $values)
    {
        $instance = $this->getInstance($values);

        $expected = $values;
        ksort($expected);

        $instance->ksort();
        $this->assertToArray($expected, $instance);
    }

    /**
     * @dataProvider sortKeyDataProvider
     */
    public function testSortByKeyUsingComparator(array $values)
    {
        $instance = $this->getInstance($values);

        $instance->ksort(function($a, $b) {
            return $a === $b ? 0 : ($a < $b ? 1 : -1);
        });

        $expected = $values;
        krsort($expected);

        $this->assertToArray($expected, $instance);
    }
}
