<?php
namespace Ds\Tests\Seq;

use PHPUnit\Framework\Attributes\DataProvider;

trait toArray
{
    #[DataProvider('basicDataProvider')]
    public function testToArray(array $values, array $expected)
    {
        $instance = $this->getInstance($values);
        $this->assertToArray($expected, $instance);
    }

    public function testToArrayEmpty()
    {
        $instance = $this->getInstance();
        $this->assertEquals([], $instance->toArray());
    }
}
