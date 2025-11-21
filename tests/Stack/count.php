<?php
namespace Ds\Tests\Stack;

use PHPUnit\Framework\Attributes\DataProvider;

trait count
{
    #[DataProvider('basicDataProvider')]
    public function testCount(array $values, array $expected)
    {
        $instance = static::getInstance($values);
        $this->assertCount(count($expected), $instance);
    }

    public function testCountEmpty()
    {
        $instance = static::getInstance();
        $this->assertCount(0, $instance);
    }
}
