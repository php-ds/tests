<?php
namespace Ds\Tests\Seq;

trait push
{
    public function testPush()
    {
        $instance = $this->getInstance();

        $instance->push('a');
        $this->assertToArray(['a'], $instance);

        $instance->push('b');
        $this->assertToArray(['a', 'b'], $instance);

        $instance->push('c');
        $this->assertToArray(['a', 'b', 'c'], $instance);
    }

    public function testPushVariadic()
    {
        $instance = $this->getInstance();
        $instance->push('a', 'b', 'c');
        $this->assertToArray(['a', 'b', 'c'], $instance);
    }

    public function testPushMany()
    {
        $instance = $this->getInstance();

        for ($i = 0; $i < self::MANY; $i++) {
            $instance->push($i);
        }

        $this->assertToArray(range(0, self::MANY - 1), $instance);
        $this->assertCount(self::MANY, $instance);
    }

    public function testArrayAccessPush()
    {
        $instance = $this->getInstance();
        $instance[] = 'a';
        $instance[] = 'b';
        $instance[] = 'c';
        $this->assertToArray(['a', 'b', 'c'], $instance);
    }
}
