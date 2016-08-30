<?php
namespace Ds\Tests\Sequence;

trait partition
{
    public function partitionDataProvider()
    {
        // values, expected, boundary, predicate
        return [
            [[], [], 0, function(){}],

            [[1, 2, 3, 4, 5],    [2, 4, 1, 3, 5],    2, function($v) { return $v % 2 == 0; }],
            [[1, 2, 3, 4, 5, 6], [2, 4, 6, 1, 3, 5], 3, function($v) { return $v % 2 == 0; }],

            [['a', 'B', 'A', 'b'], ['a', 'b', 'B', 'A'], 2, function($v) { return ctype_lower($v); }],
            [['a', 'b', 'c', 'd'], ['a', 'b', 'c', 'd'], 4, function($v) { return ctype_lower($v); }],
            [['a', 'b', 'c', 'd'], ['a', 'b', 'c', 'd'], 0, function($v) { return ctype_upper($v); }],
        ];
    }

    /**
     * @dataProvider partitionDataProvider
     */
    public function testPartition(
        array    $values,
        array    $expected,
        int      $boundary,
        callable $predicate
    ) {
        $instance = $this->getInstance($values);

        $this->assertEquals($boundary, $instance->partition($predicate));
        $this->assertToArray($expected, $instance);
    }

    public function testPartitionWithoutPredicate()
    {
        $instance = $this->getInstance([0, 1, true, false, '0', '1', '2']);

        $expected = [1, true, '1', '2', 0, false, '0'];

        $this->assertEquals(4, $instance->partition());
        $this->assertToArrayStrict($expected, $instance);
    }
}
