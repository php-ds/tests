<?php
namespace Ds\Tests\Set;

trait xor_
{
    public function xorDataProvider()
    {
        // Values in either A or B, but not both.
        // A, B, expected result
        return [
            [[],          [],           []],
            [['a'],       ['b'],        ['a', 'b']],
            [['a', 'b'],  ['b'],        ['a']],
            [['a', 'b'],  ['b', 'a'],   []],
        ];
    }

    /**
     * @dataProvider xorDataProvider
     */
    public function testXor(array $a, array $b, array $expected)
    {
        $a = $this->getInstance($a);
        $b = $this->getInstance($b);

        $this->assertEquals($expected, $a->xor($b)->toArray());
    }

    // /**
    //  * @dataProvider xorDataProvider
    //  */
    // public function testXorOperator(array $a, array $b, array $expected)
    // {
    //     $a = $this->getInstance($a);
    //     $b = $this->getInstance($b);

    //     $this->assertEquals($expected, ($a ^ $b)->toArray());
    // }

    // /**
    //  * @dataProvider xorDataProvider
    //  */
    // public function testXorOperatorAssign(array $a, array $b, array $expected)
    // {
    //     $a = $this->getInstance($a);
    //     $b = $this->getInstance($b);

    //     $a ^= $b;
    //     $this->assertEquals($expected, $a->toArray());
    // }

    /**
     * @dataProvider xorDataProvider
     */
    public function testXorWithSelf(array $a, array $b, array $expected)
    {
        $a = $this->getInstance($a);
        $this->assertEquals([], $a->xor($a)->toArray());
    }

    // /**
    //  * @dataProvider xorDataProvider
    //  */
    // public function testXorOperatorWithSelf(array $a, array $b, array $expected)
    // {
    //     $a = $this->getInstance($a);
    //     $this->assertEquals([], ($a ^ $a)->toArray());
    // }

    // /**
    //  * @dataProvider xorDataProvider
    //  */
    // public function testXorOperatorAssignWithSelf(array $a, array $b, array $expected)
    // {
    //     $a = $this->getInstance($a);

    //     $a ^= $a;
    //     $this->assertEquals([], $a->toArray());
    // }
}
