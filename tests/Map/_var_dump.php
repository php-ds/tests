<?php
namespace Ds\Tests\Map;

use PHPUnit\Framework\Attributes\DataProvider;

use Ds\Pair;

trait _var_dump
{
    public static function varDumpDataProvider()
    {
        // values, expected array repr
        return [
            [
                [],
                [],
            ],
            [
                ['a'],
                [new Pair(0, 'a')],
            ],
            [
                ['a', 'b'],
                [new Pair(0, 'a'), new Pair(1, 'b')],
            ],
        ];
    }

    #[DataProvider('varDumpDataProvider')]
    public function testVarDump(array $values, array $expected)
    {
        $instance = static::getInstance($values);
        $this->assertInstanceDump($expected, $instance);
    }
}
