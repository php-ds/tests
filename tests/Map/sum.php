<?php
namespace Ds\Tests\Map;

trait sum
{
    public function sumDataProvider()
    {
        $nonNumbers = version_compare(PHP_VERSION, '8.3.0', '>=') ? [true, false, null] : ["a", true, false, null];
        return [

            // Empty
            [[], 0],

            // Basic integer sum
            [[1, 2, 3], 6],

            // Basic float sum
            [[1.5, 2.5, 5.1], 9.1],

            // Mixed numeric
            [[1.5, 3], 4.5],

            // Numeric strings
            [["2", "5", "10.5"], 17.5],

            // Non-numbers
            [$nonNumbers, 1],
        ];
    }

    /**
     * @dataProvider sumDataProvider
     */
    public function testSum($values, $expected)
    {
        $instance = $this->getInstance($values);
        $this->assertEquals($expected, $instance->sum());
    }
}
