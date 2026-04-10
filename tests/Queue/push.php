<?php
namespace Ds\Tests\Queue;

use PHPUnit\Framework\Attributes\DataProvider;

trait push
{
    public static function pushDataProvider()
    {
        return static::basicDataProvider();
    }


    #[DataProvider('pushDataProvider')]
    public function testPushVariadic(array $values, array $expected)
    {
        $instance = $this->getInstance();

        $instance->push(...$values);

        $this->assertToArray($expected, $instance);
        $this->assertCount(count($expected), $instance);
    }


    #[DataProvider('pushDataProvider')]
    public function testPush(array $values, array $expected)
    {
        $instance = $this->getInstance();

        foreach ($values as $value) {
            $instance->push($value);
        }

        $this->assertToArray($expected, $instance);
        $this->assertCount(count($expected), $instance);
    }


    #[DataProvider('pushDataProvider')]
    public function testArrayAccessPush(array $values, array $expected)
    {
        $instance = $this->getInstance();

        foreach ($values as $value) {
            $instance[] = $value;
        }

        $this->assertToArray($expected, $instance);
        $this->assertCount(count($expected), $instance);
    }


    #[DataProvider('pushDataProvider')]
    public function testArrayAccessPushByMethod(array $values, array $expected)
    {
        $instance = $this->getInstance();

        foreach ($values as $value) {
            $instance->offsetSet(null, $value);
        }

        $this->assertToArray($expected, $instance);
        $this->assertCount(count($expected), $instance);
    }

    public function testPushCircularReference()
    {
        $instance = $this->getInstance();
        $instance->push($instance);
        $this->assertToArray([$instance], $instance);
    }
}
