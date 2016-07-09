<?php
namespace Ds\Tests\Queue;

use Ds\Queue;

trait __construct
{
    public function constructDataProvider()
    {
        return [
            [[]],
            [['a']],
            [['a', 'a']],
            [['a', 'b']],
            [$this->sample()],
        ];
    }

    /**
     * @dataProvider constructDataProvider
     */
    public function testConstruct(array $values)
    {
        $this->assertToArray($values, new Queue($values));
    }

    /**
     * @dataProvider constructDataProvider
     */
    public function testConstructUsingIterable(array $values)
    {
        $this->assertToArray($values, new Queue(new \ArrayIterator($values)));
    }

    public function testConstructCapacity()
    {
        $m = \Ds\Queue::MIN_CAPACITY;
        $n = $m + 2;

        $this->assertEquals($m,     (new Queue($m))->capacity());
        $this->assertEquals($m * 2, (new Queue($n))->capacity());
    }

    public function testConstructNoParams()
    {
        $this->assertToArray([], new Queue());
    }
}
