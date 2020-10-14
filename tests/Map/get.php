<?php
namespace Ds\Tests\Map;

trait get
{
    public function getDataProvider()
    {
        // initial, key, expected
        return [
            [['a' => 1], 'a', 1],
        ];
    }

    /**
     * @dataProvider getDataProvider
     */
    public function testGet(array $initial, $key, $expected)
    {
        $instance = $this->getInstance($initial);
        $this->assertEquals($expected, $instance->get($key));
    }

    public function testGetDefault()
    {
        $instance = $this->getInstance();
        $this->assertEquals('a', $instance->get('?', 'a'));
    }

    public function testGetKeyNotFound()
    {
        $instance = $this->getInstance();
        $this->expectKeyNotFoundException();
        $instance->get('?');
    }

    public function testArrayAccessGet()
    {
        $instance = $this->getInstance(['a' => 1]);
        $this->assertEquals(1, $instance['a']);
    }

    public function testArrayAccessGetByMethod()
    {
        $instance = $this->getInstance(['a' => 1]);
        $this->assertEquals(1, $instance->offsetGet('a'));
    }

    public function testArrayAccessGetByReference()
    {
        $instance = $this->getInstance(['a' => [1]]);
        $this->assertEquals(1, $instance['a'][0]);
    }

    public function testArrayAccessGetKeyNotFound()
    {
        $instance = $this->getInstance(['a' => 1]);
        $this->expectKeyNotFoundException();
        $instance['b'];
    }

    public function testArrayAccessGetNullCoalesce()
    {
        $instance = $this->getInstance();

        $obj = new \stdClass;

        $this->assertEquals(null, $instance[false] ?? null);
        $this->assertEquals(null, $instance[[]] ?? null);
        $this->assertEquals(null, $instance[$obj] ?? null);
        $this->assertEquals(null, $instance[0] ?? null);

        $instance->put(false, 1);
        $instance->put([], 2);
        $instance->put($obj, 3);
        $instance->put(0, 4);

        $this->assertEquals(1, $instance[false] ?? null);
        $this->assertEquals(2, $instance[[]] ?? null);
        $this->assertEquals(3, $instance[$obj] ?? null);
        $this->assertEquals(4, $instance[0] ?? null);
    }
}
