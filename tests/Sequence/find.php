<?php
namespace Ds\Tests\Sequence;

trait find
{
    public function findDataProvider()
    {
        // initial, value, expected
        return [

            [[], 0, null],

            [['a'], 'a', 0],
            [['a'], 'b', null],

            [['a', 'b'], 'a', 0],
            [['a', 'b'], 'b', 1],
            [['a', 'b'], 'c', null],

            [['a', 'b', 'c'], 'a', 0],
            [['a', 'b', 'c'], 'b', 1],
            [['a', 'b', 'c'], 'c', 2],
            [['a', 'b', 'c'], 'd', null],
        ];
    }

    /**
     * @dataProvider findDataProvider
     */
    public function testFind($initial, $value, $expected)
    {
        $instance = $this->getInstance($initial);
        $this->assertEquals($expected, $instance->find($value));
    }
}
