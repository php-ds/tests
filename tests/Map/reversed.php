<?php
namespace Ds\Tests\Map;

trait reversed
{
    public function reversedDataProvider()
    {
        $reverse = function($a) {
            return [$a[0], array_reverse($a[1], 1)];
        };

        return array_map($reverse, $this->basicDataProvider());
    }

    /**
     * @dataProvider reversedDataProvider
     */
    public function testReversed(array $values, array $expected)
    {
        $instance = $this->getInstance($values);
        $this->assertToArray($expected, $instance->reversed());
    }
}
