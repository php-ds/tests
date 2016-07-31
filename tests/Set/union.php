<?php
namespace Ds\Tests\Set;

trait union
{
    public function unionDataProvider()
    {
        // Values in A and values in B.
        // A, B, expected result
        return [
            [[],          [],       []],
            [[],          ['a'],    ['a']],
            [['a'],       ['a'],    ['a']],
            [['a'],       ['b'],    ['a', 'b']],
            [['a', 'b'],  [],       ['a', 'b']],
        ];
    }

    /**
     * @dataProvider unionDataProvider
     */
    public function testUnion(array $initial, array $values, array $expected)
    {
        $a = $this->getInstance($initial);
        $b = $this->getInstance($values);

        $this->assertEquals($expected, $a->union($b)->toArray());
    }

    /** @test */
    public function testUnionDoesNotFreezeWhenOperatingOnSetsWithObjects()
    {
        $setA = $this->getInstance([new Box("X")]);
        $setB = $this->getInstance([new Box("Y")]);

        // PHP hangs when calling union on the above sets
        $result = $setA->union($setB);

        $this->assertTrue($result->toArray() === ["X", "Y"]);
    }

    // /**
    //  * @dataProvider unionDataProvider
    //  */
    // public function testUnionOperator(array $initial, array $values, array $expected)
    // {
    //     $a = $this->getInstance($initial);
    //     $b = $this->getInstance($values);

    //     $this->assertEquals($expected, ($a | $b)->toArray());
    // }

    // /**
    //  * @dataProvider unionDataProvider
    //  */
    // public function testUnionOperatorAssign(array $initial, array $values, array $expected)
    // {
    //     $a = $this->getInstance($initial);
    //     $b = $this->getInstance($values);

    //     $a |= $b;
    //     $this->assertEquals($expected, $a->toArray());
    // }

    /**
     * @dataProvider unionDataProvider
     */
    public function testUnionWithSelf(array $initial, array $values, array $expected)
    {
        $a = $this->getInstance($initial);
        $this->assertEquals($initial, $a->union($a)->toArray());
    }

    // /**
    //  * @dataProvider unionDataProvider
    //  */
    // public function testUnionOperatorWithSelf(array $initial, array $values, array $expected)
    // {
    //     $a = $this->getInstance($initial);
    //     $this->assertEquals($initial, ($a | $a)->toArray());
    // }

    // /**
    //  * @dataProvider unionDataProvider
    //  */
    // public function testUnionOperatorAssignWithSelf(array $initial, array $values, array $expected)
    // {
    //     $a = $this->getInstance($initial);

    //     $a |= $a;
    //     $this->assertEquals($initial, $a->toArray());
    // }
}

class Box implements \Ds\Hashable
{
    private $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function equals($obj) : bool
    {
        return $this->value === $obj->value;
    }

    public function hash()
    {
        return 0;
    }
}
