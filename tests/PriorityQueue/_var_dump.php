<?php
namespace Ds\Tests\PriorityQueue;

use PHPUnit\Framework\Attributes\DataProvider;

trait _var_dump
{

    #[DataProvider('basicDataProvider')]
    public function testVarDump(array $values, array $expected)
    {
        $instance = $this->getInstance($values);
        $this->assertInstanceDump($expected, $instance);
    }
}
