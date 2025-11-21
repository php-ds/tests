<?php
namespace Ds\Tests\Deque;

use PHPUnit\Framework\Attributes\DataProvider;

use Ds\Deque;

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
        $this->assertToArray($expected, new Deque($values));
    }

   #[DataProvider('constructDataProvider')]
    public function testConstructUsingNonArrayIterable(array $values, array $expected)
    {
        $this->assertToArray($expected, new Deque(new \ArrayIterator($values)));
    }

    public function testConstructNoParams()
    {
        $this->assertToArray([], new Deque());
    }
}
