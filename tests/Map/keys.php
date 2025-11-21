<?php
namespace Ds\Tests\Map;

use PHPUnit\Framework\Attributes\DataProvider;

trait keys
{
    public static function keysDataProvider()
    {
        return [
            [[], []],
            [['a' => 1, 'b' => 2], ['a', 'b']],
            [range(0, self::MANY), range(0, self::MANY)],
        ];
    }

    #[DataProvider('keysDataProvider')]
    public function testKeys(array $initial, array $expected)
    {
        $instance = static::getInstance($initial);
        $keys = $instance->keys();

        $this->assertInstanceOf(\Ds\Set::class, $keys);
        $this->assertEquals($expected, $keys->toArray());
    }
}
