<?php
namespace Ds\Tests\Sequence;

trait any
{
    public function anyDataProvider()
    {
        // values, expected
        return [
            [
                [], false
            ],
            [
                [1], true
            ],
            [
                [1, 2, 3], true
            ],
            [
                [0, 1, 2], true
            ],
            [
                [0, 0, 1], true
            ],
            [
                [0, 0, 0], false
            ],
            [
                [0], false
            ],
            [
                ["0"], false
            ],
            [
                [[]], false
            ],
        ];
    }

    /**
     * @dataProvider anyDataProvider
     */
    public function testAny(array $values, bool $expected)
    {
        $instance = $this->getInstance($values);
        $this->assertEquals($expected, $instance->any());
    }

    public function anyDataPredicateProvider()
    {
        return [
            [
                [1, 2, 3], true, function($value) { return $value % 2 == 0; },
            ],
            [
                [2, 4, 6], false, function($value) { return $value & 1; },
            ],
            [
                ['a', 1], true, function($value) { return is_string($value); },
            ],
        ];
    }


    /**
     * @dataProvider anyDataPredicateProvider
     */
    public function testAnyUsingPredicate(array $values, bool $expected, callable $predicate)
    {
        $instance = $this->getInstance($values);
        $this->assertEquals($expected, $instance->any($predicate));
    }

    public function testAnyShortCircuit()
    {
        $instance = $this->getInstance(['a', 'b', 'c', null, 'd', 'e', 'f']);
        $string   = '';

        $instance->any(function($value) use (&$string) {
            $string .= $value;
            return !! $value;
        });

        $this->assertEquals('a', $string);
    }
}
