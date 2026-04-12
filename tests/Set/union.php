<?php
namespace Ds\Tests\Set;

use PHPUnit\Framework\Attributes\DataProvider;

trait union
{
    public static function unionDataProvider()
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


    #[DataProvider('unionDataProvider')]
    public function testUnion(array $initial, array $values, array $expected)
    {
        $a = $this->getInstance($initial);
        $b = $this->getInstance($values);

        $this->assertEquals($expected, $a->union($b)->toArray());
    }


    #[DataProvider('unionDataProvider')]
    public function testUnionWithSelf(array $initial, array $values, array $expected)
    {
        $a = $this->getInstance($initial);
        $this->assertEquals($initial, $a->union($a)->toArray());
    }

    public function testUnionWhenOperatingOnSetsWithObjectsWithNonZeroHash()
    {
        $a = new \Ds\Tests\KeyObject("a", rand());
        $b = new \Ds\Tests\KeyObject("b", rand());

        $setA = $this->getInstance([$a]);
        $setB = $this->getInstance([$b]);

        $this->assertToArray([$a, $b], $setA->union($setB));
    }

    public function testUnionWhenOperatingOnSetsWithObjectsWithZeroHash()
    {
        $a = new \Ds\Tests\KeyObject("a", 0);
        $b = new \Ds\Tests\KeyObject("b", 0);

        $setA = $this->getInstance([$a]);
        $setB = $this->getInstance([$b]);

        $this->assertToArray([$a, $b], $setA->union($setB));
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
