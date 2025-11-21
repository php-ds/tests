<?php
namespace Ds\Tests\Stack;

use PHPUnit\Framework\Attributes\DataProvider;

use Ds\Stack;

trait __construct
{
    public static function constructDataProvider()
    {
        return [
            [[]],
            [['a']],
            [['a', 'a']],
            [['a', 'b']],
            [self::sample()],
        ];
    }

    #[DataProvider('constructDataProvider')]
    public function testConstruct(array $values)
    {
        $this->assertToArray(array_reverse($values), new Stack($values));
    }

    #[DataProvider('constructDataProvider')]
    public function testConstructUsingIterable(array $values)
    {
        $this->assertToArray(array_reverse($values), new Stack(new \ArrayIterator($values)));
    }

    public function testConstructNoParams()
    {
        $this->assertToArray([], new Stack());
    }
}
