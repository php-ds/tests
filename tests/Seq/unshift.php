<?php
namespace Ds\Tests\Seq;

trait unshift
{
    public function testUnshift()
    {
        $instance = $this->getInstance();

        $instance->unshift('c');
        $this->assertToArray(['c'], $instance);

        $instance->unshift('b');
        $this->assertToArray(['b', 'c'], $instance);

        $instance->unshift('a');
        $this->assertToArray(['a', 'b', 'c'], $instance);
    }

    public function testUnshiftVariadic()
    {
        $instance = $this->getInstance(['c']);
        $instance->unshift('a', 'b');
        $this->assertToArray(['a', 'b', 'c'], $instance);
    }

    public function testUnshiftMany()
    {
        $instance = $this->getInstance();

        for ($i = self::MANY - 1; $i >= 0; $i--) {
            $instance->unshift($i);
        }

        $this->assertToArray(range(0, self::MANY - 1), $instance);
        $this->assertCount(self::MANY, $instance);
    }

    public function testUnshiftOnEmpty()
    {
        $instance = $this->getInstance();
        $instance->unshift('a');
        $this->assertToArray(['a'], $instance);
    }
}
