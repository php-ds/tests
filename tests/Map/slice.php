<?php
namespace Ds\Tests\Map;

trait slice
{
    public function sliceDataProvider()
    {
        $a = ['a', 'b', 'c'];
        $n = count($a);

        $data = [];

        for ($i = -$n; $i <= $n; $i++) {
            for ($j = -$n; $j <= $n; $j++) {
                $data[] = [[], $i, $j];
                $data[] = [$a, $i, $j];
            }
        }

        return $data;
    }

    /**
     * @dataProvider sliceDataProvider
     */
    public function testSlice(array $values, int $index, int $length)
    {
        $instance = $this->getInstance($values);

        $sliced = $instance->slice($index, $length);
        $expected = array_slice($values, $index, $length, true);

        $this->assertToArray($values, $instance);
        $this->assertToArray($expected, $sliced);
    }

    /**
     * @dataProvider sliceDataProvider
     */
    public function testSliceWithoutLength(array $values, int $index, int $length)
    {
        $instance = $this->getInstance($values);

        $sliced = $instance->slice($index);
        $expected = array_slice($values, $index, null, true);

        $this->assertToArray($values, $instance);
        $this->assertToArray($expected, $sliced);
    }

    /**
     * @dataProvider sliceDataProvider
     */
    public function testSliceWithLengthNull(array $values, int $index, int $length)
    {
        $instance = $this->getInstance($values);

        $sliced = $instance->slice($index, null);
        $expected = array_slice($values, $index, null, true);

        $this->assertToArray($values, $instance);
        $this->assertToArray($expected, $sliced);
    }

    public function testSliceAfterRemoveOutsideOfSlice()
    {
        $instance = $this->getInstance(['a', 'b', 'c', 'd', 'e']);
        $instance->remove(3); // d

        $this->assertToArray(['a', 'b', 'c'], $instance->slice(0, 3));
    }

    public function testSliceAfterRemoveAtStartOfSlice()
    {
        $instance = $this->getInstance(['a', 'b', 'c', 'd', 'e']);
        $instance->remove(1); // b

        $this->assertToArray([
            2 => 'c',
            3 => 'd',
            4 => 'e',
        ], $instance->slice(1));
    }

    public function testSliceAfterRemoveWithinSlice()
    {
        $instance = $this->getInstance(['a', 'b', 'c', 'd', 'e']);
        $instance->remove(2); // c

        $this->assertToArray([
            1 => 'b',
            3 => 'd',
            4 => 'e',
        ], $instance->slice(1));
    }
}
