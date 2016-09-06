<?php
namespace Ds\Tests\Map;

trait last
{
    public function lastDataProvider()
    {
        // initial, returned
        return [
            [['a'],             [0, 'a']],
            [['a', 'b'],        [1, 'b']],
            [['a', 'b', 'c'],   [2, 'c']],
        ];
    }

    /**
     * @dataProvider lastDataProvider
     */
    public function testLast($initial, $expected)
    {
        $instance = $this->getInstance($initial);
        $last = $instance->last();

        $this->assertEquals($expected, [$last[0], $last[1]]);
    }

    public function testLastNotAllowedWhenEmpty()
    {
        $instance = $this->getInstance();
        $this->expectEmptyNotAllowedException();
        $instance->last();
    }
}
