<?php
namespace Ds\Tests\Seq;

trait count
{
    public function testCount()
    {
        $instance = $this->getInstance(['a', 'b', 'c']);
        $this->assertCount(3, $instance);
    }

    public function testCountEmpty()
    {
        $instance = $this->getInstance();
        $this->assertCount(0, $instance);
    }

    public function testCountAfterPush()
    {
        $instance = $this->getInstance();
        $instance->push('a');
        $instance->push('b');
        $this->assertCount(2, $instance);
    }

    public function testCountFunction()
    {
        $instance = $this->getInstance(['a', 'b', 'c']);
        $this->assertEquals(3, count($instance));
    }
}
