<?php
namespace Ds\Tests\Seq;

use PHPUnit\Framework\Attributes\DataProvider;

trait contains
{
    public static function containsDataProvider()
    {
        // initial, values, expected
        return [
            // Empty seq contains nothing
            [[], [], true],
            [[], ['a'], false],

            // Single value
            [['a'], ['a'], true],
            [['a'], ['b'], false],

            // Multiple values - all must exist
            [['a', 'b', 'c'], ['a', 'b'], true],
            [['a', 'b', 'c'], ['a', 'b', 'c'], true],
            [['a', 'b', 'c'], ['a', 'd'], false],

            // Strict comparison
            [[1], ['1'], false],
            [['1'], [1], false],
            [[0], [false], false],
            [[0], [null], false],
            [[''], [null], false],
        ];
    }


    #[DataProvider('containsDataProvider')]
    public function testContains(array $initial, array $values, bool $expected)
    {
        $instance = $this->getInstance($initial);
        $this->assertEquals($expected, $instance->contains(...$values));
    }

    public function testContainsWithObject()
    {
        $obj = new \stdClass();
        $instance = $this->getInstance([$obj]);

        $this->assertTrue($instance->contains($obj));
        $this->assertFalse($instance->contains(new \stdClass()));
    }
}
