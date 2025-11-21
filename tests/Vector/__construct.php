<?php
namespace Ds\Tests\Vector;

use PHPUnit\Framework\Attributes\DataProvider;

use Ds\Vector;

trait __construct
{
    public static function constructDataProvider()
    {
        return array_map(function($a) { return [$a, $a]; }, [
            [],
            ['a'],
            ['a', 'b'],
            ['a', 'b', 'c'],
            self::sample(),
            range(1, self::MANY),
        ]);
    }

    #[DataProvider('constructDataProvider')]
    public function testConstruct($values, array $expected)
    {
        $this->assertToArray($expected, new Vector($values));
    }

   #[DataProvider('constructDataProvider')]
    public function testConstructUsingNonArrayIterable(array $values, array $expected)
    {
        $this->assertToArray($expected, new Vector(new \ArrayIterator($values)));
    }

    public function testConstructNoParams()
    {
        $this->assertToArray([], new Vector());
    }
}
