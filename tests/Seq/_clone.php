<?php
namespace Ds\Tests\Seq;

use PHPUnit\Framework\Attributes\DataProvider;

trait _clone
{
    #[DataProvider('basicDataProvider')]
    public function testClone(array $values, array $expected)
    {
        $instance = $this->getInstance($values);
        $clone = clone $instance;

        $this->assertEquals(get_class($instance), get_class($clone));
        $this->assertToArray($expected, $clone);
        $this->assertFalse($clone === $instance);
    }
}
