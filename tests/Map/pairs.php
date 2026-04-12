<?php
namespace Ds\Tests\Map;

use PHPUnit\Framework\Attributes\DataProvider;

use Ds\Seq;

trait pairs
{
    public static function pairsDataProvider()
    {
        return [
            [[], []],
            [['a' => 1, 'b' => 2], [['a', 1], ['b', 2]]],
        ];
    }


    #[DataProvider('pairsDataProvider')]
    public function testPairs(array $initial, array $expected)
    {
        $instance = $this->getInstance($initial);
        $pairs = $instance->pairs();

        $this->assertInstanceOf(Seq::class, $pairs);

        $to_array = function ($pair) {
            return [$pair->key, $pair->value];
        };

        $this->assertEquals($expected, array_map($to_array, $pairs->toArray()));
    }

    public function testObjectsAreMutableThroughAccess()
    {
        $key = new \stdClass();
        $key->state = true;

        $instance = $this->getInstance();
        $instance->put($key, 1);

        $instance->pairs()->first()->key->state = false;

        $this->assertFalse($key->state);
        $this->assertFalse($instance->pairs()->first()->key->state);
    }

    public function testKeysAreReadonly()
    {
        $instance = $this->getInstance(['a' => 1, 'b' => 2]);
        $this->expectException(\Error::class);
        $instance->pairs()->first()->key = 'c';
    }
}
