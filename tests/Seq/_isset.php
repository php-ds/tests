<?php
namespace Ds\Tests\Seq;

trait _isset
{
    public function testArrayAccessIsset()
    {
        $instance = $this->getInstance(['a', 'b', 'c']);

        $this->assertTrue(isset($instance[0]));
        $this->assertTrue(isset($instance[1]));
        $this->assertTrue(isset($instance[2]));

        $this->assertFalse(isset($instance[3]));
        $this->assertFalse(isset($instance[-1]));
    }

    public function testArrayAccessIssetByMethod()
    {
        $instance = $this->getInstance(['a', 'b', 'c']);

        $this->assertTrue($instance->offsetExists(0));
        $this->assertTrue($instance->offsetExists(1));
        $this->assertTrue($instance->offsetExists(2));

        $this->assertFalse($instance->offsetExists(3));
    }
}
