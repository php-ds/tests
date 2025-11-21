<?php
namespace Ds\Tests\Stack;

trait clear
{
    public function testClear()
    {
        $instance = static::getInstance(self::sample());
        $instance->clear();

        $this->assertToArray([], $instance);
        $this->assertCount(0, $instance);
    }
}
