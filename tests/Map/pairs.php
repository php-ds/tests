<?php
namespace Ds\Tests\Map;

use Ds\Vector;

trait pairs
{
    /**
     * @dataProvider pairsDataProvider
     */
    public function testPairs(array $initial, array $expected)
    {
        $instance = $this->getInstance($initial);
        $pairs = $instance->pairs();

        $this->assertInstanceOf(Vector::class, $pairs);

        $to_array = function ($pair) {
            return [$pair->key, $pair->value];
        };

        $this->assertEquals($expected, array_map($to_array, $pairs->toArray()));
    }

    public function testPairsAreNotReferences()
    {
        $obj = new \stdClass();
        $obj->state = true;

        $instance = $this->getInstance();
        $instance->put($obj, 1);

        $pairs = $instance->pairs()->toArray();
        $pairs[0]->key->state = false;

        $this->assertTrue($obj->state);
        $this->assertFalse($pairs[0]->key->state);
    }
}
