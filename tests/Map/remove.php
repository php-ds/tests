<?php
namespace Ds\Tests\Map;

use PHPUnit\Framework\Attributes\DataProvider;

use Ds\Tests\HashableObject;

trait remove
{
    public static function removeDataProvider()
    {
        $o = new \stdClass();

        // initial pairs, key, return, result
        return [

            // Test basic removal
            [[['a', 1], ['b', 2]], 'a', 1, ['b' => 2]],

            // Test removing an object works
            [[[$o, 'x'], ['a', 1]], $o, 'x', ['a' => 1]],

            // Test that removing a null key works
            [[[null, '#'], ['a', 1]], null, '#', ['a' => 1]],
        ];
    }

    public static function removeHashableDataProvider()
    {
        // Two objects with the same hash code and equals.
        $h1 = new HashableObject(1);
        $h2 = new HashableObject(1);

        // put pairs, expected pairs
        return [
            [[[$h1, $h2]], $h1, $h2, []],
        ];
    }

    #[DataProvider('removeHashableDataProvider')]
    public function testRemoveHashable(array $initial, $key, $expected, array $result)
    {
        $this->testRemove($initial, $key, $expected, $result);
    }

    public function testRemoveAllFromFront()
    {
        $instance = static::getInstance();

        for ($i = 0; $i < self::MANY; $i++) {
            $instance->put($i, $i);
        }

        for ($i = 0; $i < self::MANY; $i++) {
            $instance->remove($i);
        }

        $this->assertCount(0, $instance);
        $this->assertToArray([], $instance);
        $this->assertTrue($instance->isEmpty());
    }

    public function testRemoveHalfFromMidway()
    {
        $instance = static::getInstance();

        $size = self::MANY + (self::MANY & 1); // Force even
        $half = intdiv($size, 2);

        for ($i = 1; $i <= $size; $i++) {
            $instance->put($i, $i);
        }

        for ($i = $half + 1; $i <= $size; $i++) {
            $instance->remove($i);
        }

        $this->assertCount($half, $instance);
    }

    public function testRandomRemove()
    {
        $instance  = static::getInstance();
        $reference = [];

        for ($i = 0; $i < 10; $i++) {

            for ($i = 0; $i < self::MANY; $i++) {
                $k = rand(0, self::MANY * 2);
                $v = rand();

                $reference[$k] = $v;
                $instance[$k]  = $v;
            }

            for ($i = 0; $i < self::MANY; $i++) {
                $k = rand(0, self::MANY * 2);


                unset($reference[$k]);
                unset($instance[$k]);
            }
        }

        $this->assertToArray($reference, $instance);
    }

    #[DataProvider('removeDataProvider')]
    public function testRemove(array $initial, $key, $expected, array $result)
    {
        $instance = static::getInstance();

        foreach ($initial as $pair) {
            $instance->put($pair[0], $pair[1]);
        }

        $this->assertEquals($expected, $instance->remove($key));
        $this->assertToArray($result, $instance);
    }

    public function testRemoveDefault()
    {
        $instance = static::getInstance();
        $this->assertEquals('a', $instance->remove('?', 'a'));
    }

    public function testRemoveKeyNotFound()
    {
        $instance = static::getInstance();
        $this->expectKeyNotFoundException();
        $instance->remove('?');
    }
}
