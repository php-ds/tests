<?php
namespace Ds\Tests\Map;

use PHPUnit\Framework\Attributes\DataProvider;

use Ds\Map;

trait __construct
{
    public static function constructDataProvider()
    {
        return array_map(function($a) { return [$a, $a]; }, [
            [],
            ['a' => 1],
            ['a' => 1, 'b' => 2],
            ['a' => 1, 'b' => 2, 'c' => 3],
            self::sample(),
        ]);
    }

    #[DataProvider('constructDataProvider')]
    public function testConstruct(array $values, array $expected)
    {
        $this->assertToArray($expected, new Map($values));
    }

    #[DataProvider('constructDataProvider')]
    public function testConstructUsingNonArrayIterable(array $values, array $expected)
    {
        $this->assertToArray($expected, new Map(new \ArrayIterator($values)));
    }

    public function testConstructNoParams()
    {
        $this->assertToArray([], new Map());
    }
}
