<?php
namespace Ds\Tests\Queue;

use PHPUnit\Framework\Attributes\DataProvider;

trait _clone
{
    #[DataProvider('basicDataProvider')]
    public function testClone($values, array $expected)
    {
        $instance = static::getInstance($values);

        $clone = clone $instance;

        $this->assertEquals(get_class($instance), get_class($clone));
        $this->assertEquals($instance->toArray(), $clone->toArray());
        $this->assertFalse($clone === $instance);
    }
}
