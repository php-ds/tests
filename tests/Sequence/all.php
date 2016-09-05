<?php
namespace Ds\Tests\Sequence;

trait all
{
    public function allDataProvider()
    {
        // values, expected
        return [
            [
                [], true,
            ],
            [
                [1], true,
            ],
            [
                [1, 2, 3], true,
            ],
            [
                [0], false,
            ],
            [
                ["0"], false,
            ],
            [
                [[]], false
            ],
        ];
    }

    /**
     * @dataProvider allDataProvider
     */
    public function testAll(array $values, bool $expected)
    {
        $instance = $this->getInstance($values);
        $this->assertEquals($expected, $instance->all());
    }

    public function allDataPredicateProvider()
    {
        return [
            [
                [2, 4, 6], true, function($value) { return $value % 2 == 0; },
            ],
            [
                [2, 4, 6], false, function($value) { return $value & 1; },
            ],
            [
                ['a', 'b'], true, function($value) { return is_string($value); },
            ],
        ];
    }


    /**
     * @dataProvider allDataPredicateProvider
     */
    public function testAllUsingPredicate(array $values, bool $expected, callable $predicate)
    {
        $instance = $this->getInstance($values);
        $this->assertEquals($expected, $instance->all($predicate));
    }

    public function testAllShortCircuit()
    {
        $instance = $this->getInstance(['a', 'b', 'c', false, 'd', 'e', 'f']);
        $string   = '';

        $instance->all(function($value) use (&$string) {
            $string .= $value;
            return !! $value;
        });

        $this->assertEquals('abc', $string);
    }
}
