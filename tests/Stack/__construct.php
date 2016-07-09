<?php
namespace Ds\Tests\Stack;

use Ds\Stack;

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
        $this->assertToArray(array_reverse($values), new Stack($values));
    }

    /**
     * @dataProvider constructDataProvider
     */
    public function testConstructUsingIterable(array $values)
    {
        $this->assertToArray(array_reverse($values), new Stack(new \ArrayIterator($values)));
    }

    public function testConstructCapacity()
    {
        $n = 20;
        $this->assertEquals($n, (new Stack($n))->capacity());
    }

    public function testConstructNoParams()
    {
        $this->assertToArray([], new Stack());
    }
}
