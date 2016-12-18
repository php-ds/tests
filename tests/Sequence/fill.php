<?php
namespace Ds\Tests\Sequence;

trait fill
{
    public function findDataProvider()
    {
        // sequence, value, count, sequenceAfterFill
        return [

            [$this->getInstance([]), 100, null, []],
            [$this->getInstance([]), 1, 5, [1, 1, 1, 1, 1]],
            [$this->getInstance([0, 0, 0, 0, 0]), 1, null, [1, 1, 1, 1, 1]],
            [$this->getInstance([0, 0, 0, 0, 0]), 1, 3, [1, 1, 1, 0, 0]],
            [$this->getInstance([0, 0, 0, 0, 0]), 1, 10, [1, 1, 1, 1, 1, 1, 1, 1, 1, 1]],
        ];
    }

    /**
     * @dataProvider findDataProvider
     */
    public function testFill($sequence, $value, $count, $sequenceAfterFill)
    {
        $sequence->fill($value, $count);
        $this->assertEquals($sequence->toArray(), $sequenceAfterFill->toArray());
    }
}
