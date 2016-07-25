<?php
namespace Ds\Tests\Map;

trait ksorted
{
    public function sortedKeyDataProvider()
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
     * @dataProvider sortedKeyDataProvider
     */
    public function testSortedByKey(array $values)
    {
        $instance = $this->getInstance($values);

        $expected = $values;
        ksort($expected);

        $this->assertToArray($expected, $instance->ksorted());
        $this->assertToArray($values, $instance);
    }

    /**
     * @dataProvider sortKeyDataProvider
     */
    public function testSortedByKeyUsingComparator(array $values)
    {
        $instance = $this->getInstance($values);

        $sorted = $instance->ksorted(function($a, $b) {
            return $b <=> $a;
        });

        $expected = $values;
        krsort($expected);

        $this->assertToArray($expected, $sorted);
        $this->assertToArray($values, $instance);
    }
}
