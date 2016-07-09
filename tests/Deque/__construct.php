<?php
namespace Ds\Tests\Deque;

use ds;
use Ds\Deque;

trait __construct
{
    public function constructDataProvider()
    {
        return array_map(function($a) { return [$a, $a]; }, [
            [],
            ['a'],
            ['a', 'b'],
            ['a', 'b', 'c'],
            $this->sample(),
            range(1, self::MANY),
        ]);
    }

    /**
     * @dataProvider constructDataProvider
     */
    public function testConstruct($values, array $expected)
    {
        $this->assertToArray($expected, new Deque($values));
        $this->assertToArray($expected, ds::deque($values));
    }

   /**
     * @dataProvider constructDataProvider
     */
    public function testConstructUsingNonArrayIterable(array $values, array $expected)
    {
        $this->assertToArray($expected, new Deque(new \ArrayIterator($values)));
        $this->assertToArray($expected, ds::deque(new \ArrayIterator($values)));
    }

    public function testConstructCapacity()
    {
        $m = \Ds\Deque::MIN_CAPACITY;
        $n = $m + 2;

        $this->assertEquals($m,     (new Deque($m))->capacity());
        $this->assertEquals($m,     (ds::deque($m))->capacity());
        $this->assertEquals($m * 2, (new Deque($n))->capacity());
        $this->assertEquals($m * 2, (ds::deque($n))->capacity());
    }

    public function testConstructNoParams()
    {
        $this->assertToArray([], new Deque());
        $this->assertToArray([], ds::deque());
    }
}
