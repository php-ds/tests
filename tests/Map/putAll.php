<?php
namespace Ds\Tests\Map;

use PHPUnit\Framework\Attributes\DataProvider;

trait putAll
{
    public static function putAllDataProvider()
    {
        // values, values
        return [
            [[]],
            [['a']],
            [['a', 'b']],
            [['a', 'b', 'c']],
            [self::sample()],
            [range(1, self::MANY)],
        ];
    }

    #[DataProvider('putAllDataProvider')]
    public function testPutAll(array $values)
    {
        $instance = static::getInstance();
        $instance->putAll($values);
        $this->assertToArray($values, $instance);
    }

    #[DataProvider('putAllDataProvider')]
    public function testPutAllUsingIterator(array $values)
    {
        $instance = static::getInstance();
        $instance->putAll(new \ArrayIterator($values));
        $this->assertToArray($values, $instance);
    }

    #[DataProvider('putAllDataProvider')]
    public function testPutAllFromSet(array $values)
    {
        $instance = static::getInstance();
        $set = new \Ds\Set($values);
        $instance->putAll($set);
        $this->assertToArray($values, $instance);
    }

    #[DataProvider('putAllDataProvider')]
    public function testPutAllFromMap(array $values)
    {
        $instance = static::getInstance();
        $map = new \Ds\Map($values);
        $instance->putAll($map);
        $this->assertToArray($values, $instance);
    }

    #[DataProvider('putAllDataProvider')]
    public function testPutAllFromVector(array $values)
    {
        $instance = static::getInstance();
        $vector = new \Ds\Vector($values);
        $instance->putAll($vector);
        $this->assertToArray($values, $instance);
    }

    #[DataProvider('putAllDataProvider')]
    public function testPutAllFromDeque(array $values)
    {
        $instance = static::getInstance();
        $deque = new \Ds\Deque($values);
        $instance->putAll($deque);
        $this->assertToArray($values, $instance);
    }

    #[DataProvider('putAllDataProvider')]
    public function testPutAllFromStack(array $values)
    {
        $instance = static::getInstance();
        $stack = new \Ds\Stack(array_reverse($values));
        $instance->putAll($stack);
        $this->assertToArray($values, $instance);
        $this->assertCount(0, $stack);
    }

    #[DataProvider('putAllDataProvider')]
    public function testPutAllFromQueue(array $values)
    {
        $instance = static::getInstance();
        $queue = new \Ds\Queue($values);
        $instance->putAll($queue);
        $this->assertToArray($values, $instance);
        $this->assertCount(0, $queue);
    }

    #[DataProvider('putAllDataProvider')]
    public function testPutAllFromPriorityQueue(array $values)
    {
        $instance = static::getInstance();
        $queue = new \Ds\PriorityQueue();

        foreach ($values as $value) {
            $queue->push($value, 0);
        }

        $instance->putAll($queue);
        $this->assertToArray($values, $instance);
        $this->assertCount(0, $queue);
    }
}
