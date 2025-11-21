<?php
namespace Ds\Tests\Queue;

use PHPUnit\Framework\Attributes\DataProvider;

trait _serialize
{
    #[DataProvider('basicDataProvider')]
    public function testSerialize(array $values, array $expected)
    {
        $instance = static::getInstance($values);
        $this->assertSerialized($expected, $instance, false);
    }
}
