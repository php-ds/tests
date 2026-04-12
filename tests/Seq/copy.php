<?php
namespace Ds\Tests\Seq;

use PHPUnit\Framework\Attributes\DataProvider;

trait copy
{
    #[DataProvider('basicDataProvider')]
    public function testCopy(array $values, array $expected)
    {
        $instance = $this->getInstance($values);
        $copy = $instance->copy();

        $this->assertEquals($instance->toArray(), $copy->toArray());
        $this->assertEquals(count($instance), count($copy));
    }

    public function testCopyIsIndependent()
    {
        $instance = $this->getInstance(['a', 'b', 'c']);
        $copy = $instance->copy();

        $copy->push('d');

        $this->assertToArray(['a', 'b', 'c'], $instance);
        $this->assertToArray(['a', 'b', 'c', 'd'], $copy);
    }

    public function testCopyEmpty()
    {
        $instance = $this->getInstance();
        $copy = $instance->copy();

        $this->assertToArray([], $copy);
        $this->assertCount(0, $copy);
    }
}
