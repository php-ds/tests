<?php
namespace Ds\Tests\Seq;

use PHPUnit\Framework\Attributes\DataProvider;

trait apply
{
    public static function applyDataProvider()
    {
        // values, callback, expected
        return [
            [[], function($v){ return $v; }, []],

            [[1, 2, 3], function ($v) { return $v * 2; }, [2, 4, 6]],
        ];
    }


    #[DataProvider('applyDataProvider')]
    public function testApply(array $values, callable $callback, array $expected)
    {
        $instance = $this->getInstance($values);
        $instance->apply($callback);

        $this->assertToArray($expected, $instance);
    }

    public function testApplyCallbackThrowsException()
    {
        $instance = $this->getInstance([1, 2, 3]);

        try {
            $instance->apply(function($value) {
                throw new \Exception();
            });
        } catch (\Exception $e) {
            $this->assertToArray([1, 2, 3], $instance);
            return;
        }

        $this->fail('Exception should have been caught');
    }

    public function testApplyCallbackThrowsExceptionLaterOn()
    {
        $instance = $this->getInstance([1, 2, 3]);

        try {
            $instance->apply(function($value) {
                if ($value === 3) {
                    throw new \Exception();
                } else {
                    return "*";
                }
            });
        } catch (\Exception $e) {
            $this->assertToArray(["*", "*", 3], $instance);
            return;
        }

        $this->fail('Exception should have been caught');
    }

    public function testApplyDoesNotLeakWhenCallbackFails()
    {
        $objects = [
            new \stdClass(),
            new \stdClass(),
            new \stdClass(),
        ];

        $instance = $this->getInstance($objects);

        static::expectException(\Exception::class);

        $count = 0;
        $instance->apply(function($value) use (&$count) {
            if ($count++ === 2) {
                throw new \Exception();
            }
            return $value;
        });
    }
}
