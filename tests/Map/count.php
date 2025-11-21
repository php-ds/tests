<?php
namespace Ds\Tests\Map;

trait count
{
    public function testCount()
    {
        $instance = static::getInstance(self::sample());
        $this->assertCount(count(self::sample()), $instance);
    }

    public function testCountEmpty()
    {
        $instance = static::getInstance();
        $this->assertCount(0, $instance);
    }
}
