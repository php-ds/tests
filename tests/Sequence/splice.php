<?php
namespace Ds\Tests\Sequence;

trait splice
{
    /**
     * array_splice:
     *
     * Removes the elements designated by offset and length from the input array
     * and replaces them with the elements of the replacement array, if supplied.
     *
     * @param input
     *  - The input array.
     *
     * @param offset
     *  - If offset is positive then the start of removed portion is at that offset from the beginning of the input array.
     *  - If offset is negative then it starts that far from the end of the input array.
     *
     * @param length
     *  - If length is omitted, removes everything from offset to the end of the array.
     *  - If length is specified and is positive, then that many elements will be removed.
     *  - If length is specified and is zero, no elements will be removed.
     *  - If length is specified and is negative then the end of the removed portion will be
     *    that many elements from the end of the array.
     *
     *  Tip: To remove everything from offset to the end of the array
     *       when replacement is also specified, use count($input) for length.
     *
     * @param replacement
     *  - If replacement array is specified, then the removed elements are replaced with elements from this array.
     *  - If offset and length are such that nothing is removed, then the elements from the replacement
     *    array are inserted in the place specified by the offset.
     *
     *  - If replacement is just one element it is not necessary to put array() around it,
     *    unless the element is an array itself, an object or NULL.
     *
     * @return Returns an array consisting of the extracted elements.
     *
     *
     *
     *
     */
    public function spliceRangeDataProvider()
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
     * @dataProvider spliceRangeDataProvider
     */
    public function testSpliceRange(array $values, int $index, int $length)
    {
        $instance = $this->getInstance($values);

        $sliced = $instance->slice($index, $length);
        $expected = array_slice($values, $index, $length);

        $this->assertToArray($values, $instance);
        $this->assertToArray($expected, $sliced);
    }

    public function testSpliceOnlyOffset()
    {
        $values = ['a', 'b', 'c'];

        foreach (range(-2, count($values) + 2) as $index) {
            $array = $values;
            $instance = $this->getInstance($array);
            $extracted = array_splice($array, $index);
            $this->assertToArray($extracted, $instance->splice($index));
            $this->assertToArray($array, $instance);
        }
    }

    public function testSpliceOnlyOffsetAndLength()
    {
        $values = ['a', 'b', 'c'];

        foreach (range(-2, count($values) + 2) as $index) {
            foreach (range(-2, count($values)) as $length) {
                $array = $values;
                $instance = $this->getInstance($array);
                $extracted = array_splice($array, $index, $length);
                $this->assertToArray($extracted, $instance->splice($index, $length));
                $this->assertToArray($array, $instance);
            }
        }
    }

    public function testSpliceOnlyOffsetLengthAndReplacement()
    {
        $values  = ['a', 'b', 'c'];
        $replace = [1, 2, 3];

        foreach (range(-2, count($values) + 2) as $index) {
            foreach (range(-2, count($values)) as $length) {
                $array = $values;
                $instance = $this->getInstance($array);
                $extracted = array_splice($array, $index, $length, $replace);
                $this->assertToArray($extracted, $instance->splice($index, $length, $replace));
                $this->assertToArray($array, $instance);
            }
        }
    }

    public function spliceDataProvider()
    {
        $values = ['a', 'b', 'c'];
        $iter   = new \ArrayObject($values);

        // array $values, $index, $length, $replacement
        return [
            [$values,  0,      2,    null], // null replacement
            [$values,  0,      null, null], // null length
            // [$values,  null,   null, null], // null offset
            // [$values, 'a',     2,    null], // non-numeric string offset
            // [$values,  0,     'a',   null], // non-numeric string length
            [$values, '0',     2,    null], // numeric string offset
            [$values,  0,     '2',   null], // numeric string length
            [$values,  0,      2,       5], // single value replacement
            [$values,  0,      2,    "ab"], // string value replacement
            [$values,  0,      2,    5000], // integer value replacement
            [$values,  0,      2,   $iter], // iterable value replacement
        ];
    }

    /**
     * @dataProvider spliceDataProvider
     */
    public function testSplice(array $values, $index, $length, $replacement)
    {
        $instance = $this->getInstance($values);
        $array    = $values;
        $spliced  = array_splice($array, $index, $length, $replacement);

        $this->assertToArray($spliced, $instance->splice($index, $length, $replacement));
        $this->assertToArray($array, $instance);
    }

    public function testNonIterableReplacementCastsToArray()
    {

    }
}
