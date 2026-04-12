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
            [static::sample()],
            [range(1, self::MANY)],
        ];
    }


    #[DataProvider('putAllDataProvider')]
    public function testPutAll(array $values)
    {
        $instance = $this->getInstance();
        $instance->putAll($values);
        $this->assertToArray($values, $instance);
    }


    #[DataProvider('putAllDataProvider')]
    public function testPutAllUsingIterator(array $values)
    {
        $instance = $this->getInstance();
        $instance->putAll(new \ArrayIterator($values));
        $this->assertToArray($values, $instance);
    }


    #[DataProvider('putAllDataProvider')]
    public function testPutAllFromSet(array $values)
    {
        $instance = $this->getInstance();
        $set = new \Ds\Set($values);
        $instance->putAll($set);
        $this->assertToArray($values, $instance);
    }


    #[DataProvider('putAllDataProvider')]
    public function testPutAllFromMap(array $values)
    {
        $instance = $this->getInstance();
        $map = new \Ds\Map($values);
        $instance->putAll($map);
        $this->assertToArray($values, $instance);
    }


    #[DataProvider('putAllDataProvider')]
    public function testPutAllFromSeq(array $values)
    {
        $instance = $this->getInstance();
        $seq = new \Ds\Seq($values);
        $instance->putAll($seq);
        $this->assertToArray($values, $instance);
    }
}
