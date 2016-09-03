<?php
namespace Ds\Tests\Map;

use Ds\Tuple;

trait _var_dump
{
    public function varDumpDataProvider()
    {
        // values, expected array repr
        return [
            [
                [],
                [],
            ],
            [
                ['a'],
                [new Tuple(0, 'a')],
            ],
            [
                ['a', 'b'],
                [new Tuple(0, 'a'), new Tuple(1, 'b')],
            ],
        ];
    }

    /**
     * @dataProvider varDumpDataProvider
     */
    public function testVarDump(array $values, array $expected)
    {
        $instance = $this->getInstance($values);
        $this->assertInstanceDump($expected, $instance);
    }
}
