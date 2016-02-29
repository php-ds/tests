<?php
namespace Ds\Tests\Map;

trait merge
{
    public function mergeDataProvider()
    {
        // A, B, expected
        return [
            [[],                    [],                 []],
            [[],                    ['a' => 1],         ['a' => 1]],
            [['a' => 1],            ['a' => 2],         ['a' => 2]],
            [['a' => 1],            ['b' => 2],         ['a' => 1, 'b' => 2]],
            [['b' => 2],            ['a' => 1],         ['b' => 2, 'a' => 1]],
            [['a' => 1, 'b' => 2],  ['c' => 3],         ['a' => 1, 'b' => 2, 'c' => 3]],
        ];
    }

    /**
     * @dataProvider mergeDataProvider
     */
    public function testMerge(array $a, array $b, array $expected)
    {
        $x = $this->getInstance($a);
        $y = $this->getInstance($b);

        $this->assertToArray($expected, $x->merge($y));
        $this->assertToArray($a, $x);
        $this->assertToArray($b, $y);
    }

    /**
     * @dataProvider mergeDataProvider
     */
    public function testMergeWithEmpty(array $a, array $b, array $expected)
    {
        $x = $this->getInstance($a);
        $y = $this->getInstance();

        $this->assertToArray($a, $x->merge($y));
        $this->assertToArray($a, $x);
        $this->assertToArray([], $y);
    }

    /**
     * @dataProvider mergeDataProvider
     */
    public function testMergeWithSelf(array $a, array $b, array $expected)
    {
        $x = $this->getInstance($a);

        $this->assertToArray($a, $x->merge($x));
        $this->assertToArray($a, $x);
    }
}
