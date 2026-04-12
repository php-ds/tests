<?php
namespace Ds\Tests\Seq;

trait shift
{
    public function testShift()
    {
        $instance = $this->getInstance(['a', 'b', 'c']);

        $this->assertEquals('a', $instance->shift());
        $this->assertToArray(['b', 'c'], $instance);

        $this->assertEquals('b', $instance->shift());
        $this->assertToArray(['c'], $instance);

        $this->assertEquals('c', $instance->shift());
        $this->assertToArray([], $instance);
    }

    public function testShiftNotAllowedWhenEmpty()
    {
        $instance = $this->getInstance();
        $this->expectEmptyNotAllowedException();
        $instance->shift();
    }
}
