<?php
namespace Ds\Tests\Queue;

use PHPUnit\Framework\Attributes\DataProvider;

trait _var_dump
{
    #[DataProvider('basicDataProvider')]
    public function testVarDump(array $values, array $expected)
    {
        $instance = static::getInstance($values);
        $this->assertInstanceDump($expected, $instance);
    }
}
