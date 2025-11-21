<?php
namespace Ds\Tests\Queue;

use PHPUnit\Framework\Attributes\DataProvider;

trait copy
{
    #[DataProvider('basicDataProvider')]
    public function testCopy(array $values, array $expected)
    {
        $instance = static::getInstance($values);
        $copy = $instance->copy();

        $this->assertEquals($instance->toArray(), $copy->toArray());
        $this->assertEquals(count($instance), count($copy));
    }
}
