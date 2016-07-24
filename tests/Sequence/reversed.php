<?php
namespace Ds\Tests\Sequence;

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
        $this->assertToArray($expected, $instance->reversed());
        $this->assertToArray($values, $instance);
    }
}
