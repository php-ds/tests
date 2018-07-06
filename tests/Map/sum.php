<?php
namespace Ds\Tests\Map;

trait sum
{
    public function sumDataProvider()
    {
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
            [["a", true, false, null], 1],
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

    public function testSumObjectCasting()
    {
        if ( ! extension_loaded('gmp')) {
            $this->markTestSkipped("GMP extension is not installed");
            return;
        }

        $instance = $this->getInstance([1, 2, gmp_init(42)]);
        $this->assertEquals(45, $instance->sum());
    }
}
