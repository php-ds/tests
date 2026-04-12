<?php
namespace Ds\Tests\Seq;

trait pop
{
    public function testPop()
    {
        $instance = $this->getInstance(['a', 'b', 'c']);

        $this->assertEquals('c', $instance->pop());
        $this->assertToArray(['a', 'b'], $instance);

        $this->assertEquals('b', $instance->pop());
        $this->assertToArray(['a'], $instance);

        $this->assertEquals('a', $instance->pop());
        $this->assertToArray([], $instance);
    }

    public function testPopNotAllowedWhenEmpty()
    {
        $instance = $this->getInstance();
        $this->expectEmptyNotAllowedException();
        $instance->pop();
    }
}
