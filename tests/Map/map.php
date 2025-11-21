<?php
namespace Ds\Tests\Map;

use PHPUnit\Framework\Attributes\DataProvider;

trait map
{
    public static function mapDataProvider()
    {
        // values, callback
        return [

            // Test mapping an empty map produces an empty map.
            [[], function(){}],

            // Test basic mapping where integers are doubled.
            [[1, 2, 3], function ($k, $v) { return $v * 2; }],
        ];
    }


    #[DataProvider('mapDataProvider')]
    public function testMap(array $values, callable $callback)
    {
        $instance = static::getInstance($values);

        $mapped = $instance->map($callback);
        $expected = array_map($callback, array_keys($values), $values);

        $this->assertToArray($values, $instance);
        $this->assertEquals($expected, $mapped->toArray());
    }

    public function testMapPreservesKeys()
    {
        $instance = static::getInstance(["speed" => 5]);

        $mapped = $instance->map(function ($key, $value) {
            return $value * 2;
        });

        $this->assertToArray(["speed" => 10], $mapped);
    }

    public function testMapCallbackThrowsException()
    {
        $instance = static::getInstance([1, 2, 3]);
        $mapped = null;

        try {
            $mapped = $instance->map(function($value) {
                throw new \Exception();
            });
        } catch (\Exception $e) {
            $this->assertToArray([1, 2, 3], $instance);
            $this->assertNull($mapped);
            return;
        }

        $this->fail('Exception should have been caught');
    }

    public function testMapCallbackThrowsExceptionLaterOn()
    {
        $instance = static::getInstance([1, 2, 3]);
        $mapped = null;

        try {
            $mapped = $instance->map(function($key, $value) {
                if ($value === 3) {
                    throw new \Exception();
                }
            });
        } catch (\Exception $e) {
            $this->assertToArray([1, 2, 3], $instance);
            $this->assertNull($mapped);
            return;
        }

        $this->fail('Exception should have been caught');
    }

    public function testMapDoesNotLeakWhenCallbackFails()
    {
        $instance = static::getInstance([
            "a" => new \stdClass(),
            "b" => new \stdClass(),
            "c" => new \stdClass(),
        ]);

        static::expectException(\Exception::class);

        $mapped = $instance->map(function($key, $value) {
            if ($key === "c") {
                throw new \Exception();
            }
        });
    }
}
