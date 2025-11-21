<?php
namespace Ds\Tests\Map;

use PHPUnit\Framework\Attributes\DataProvider;

trait _foreach
{
    #[DataProvider('basicDataProvider')]
    public function testForEach(array $values, array $expected)
    {
        $instance = static::getInstance($values);
        $this->assertForEach($expected, $instance);
    }
}
