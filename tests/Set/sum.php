<?php
namespace Ds\Tests\Set;

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
        $this->markTestIncomplete(<<<TEXT
Polyfill implementation is unable to convert gmp_init(42) to 42.
Ext's ADD_TO_SUM https://github.com/php-ds/ext-ds/blob/2ddef84d3e9391c37599cb716592184315e23921/src/common.h#L87 is similar to PHP_FUNCTION(array_sum) https://github.com/php/php-src/blob/34f727e63716dfb798865289c079b017812ad03b/ext/standard/array.c#L5868 that is called within polyfill.
Both call convert_scalar_to_number().
TEXT
        );

        if ( ! extension_loaded('gmp')) {
            $this->markTestSkipped("GMP extension is not installed");
            return;
        }

        $instance = $this->getInstance([1, 2, gmp_init(42)]);
        $this->assertEquals(45, $instance->sum());
    }
}
