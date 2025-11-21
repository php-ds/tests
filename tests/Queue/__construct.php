<?php
namespace Ds\Tests\Queue;

use PHPUnit\Framework\Attributes\DataProvider;

use Ds\Queue;

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
        $this->assertToArray($values, new Queue($values));
    }

    #[DataProvider('constructDataProvider')]
    public function testConstructUsingIterable(array $values)
    {
        $this->assertToArray($values, new Queue(new \ArrayIterator($values)));
    }

    public function testConstructNoParams()
    {
        $this->assertToArray([], new Queue());
    }
}
