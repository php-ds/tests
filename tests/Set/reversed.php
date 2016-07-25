<?php
namespace Ds\Tests\Set;

trait reversed
{
    public function reversedDataProvider()
    {
        return array_map(function($a) { return [$a[0], array_reverse($a[1])]; },
            $this->basicDataProvider()
        );
    }

    /**
     * @dataProvider reversedDataProvider
     */
    public function testReversed(array $values, array $expected)
    {
        $instance = $this->getInstance($values);
        $reversed = $instance->reversed();

        $this->assertToArray($expected, $reversed);
        $this->assertToArray($values, $instance);
    }
}
