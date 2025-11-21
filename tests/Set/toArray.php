<?php
namespace Ds\Tests\Set;

use PHPUnit\Framework\Attributes\DataProvider;

trait toArray
{
    #[DataProvider('basicDataProvider')]
    public function testToArray(array $values, array $expected)
    {
        $instance = static::getInstance($values);
        $this->assertToArray($expected, $instance);
    }
}
