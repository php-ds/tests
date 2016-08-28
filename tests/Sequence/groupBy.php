<?php
namespace Ds\Tests\Sequence;

trait groupBy
{
    public function groupByStringIndexProvider()
    {
        return [
            [
                [
                    ['a' => 1],
                    ['a' => 1],
                    ['a' => 2],
                ],
                // Group by access the key 'a' on each value
                'a', [
                    1 => [['a' => 1], ['a' => 1]],
                    2 => [['a' => 2]],
                ]
            ],
        ];
    }

    public function groupByIntegerIndexProvider()
    {
        return [
            [
                [
                    [1, 2, 3],
                    [0, 2, 0],
                    ['a', 'b', 'c'],
                    ['x', 'y', 'z'],
                ],

                // Group by accessing index 1 on each value
                1, [
                     2  => [[1, 2, 3], [0, 2, 0],],
                    'b' => [['a', 'b', 'c'],],
                    'y' => [['x', 'y', 'z'],],
                ]
            ],
        ];
    }

    public function groupByCallableProvider()
    {
        return [

            // Use string callable
            [
                [6.1, 4.2, 6.3], 'floor',
                [
                    6 => [6.1, 6.3],
                    4 => [4.2],
                ]],

            // Use anonymous function
            [
                ['aa', 'ab', 'ba', 'd', 'bc'], function($value) {
                    return substr($value, 0, 1);
                },
                [
                    'a' => ['aa', 'ab'],
                    'b' => ['ba', 'bc'],
                    'd' => ['d'],
                ],
            ],
        ];
    }

    private function transformGroupByForObjects(array &$values)
    {
        foreach ($values as &$value) {
            $obj = new \stdClass();

            foreach ($value as $key => $item) {
                $obj->$key = $item;
            }

            $value = $obj;
        }
    }

    private function transformGroupByForArrayAccess(array &$values)
    {
        foreach ($values as &$value) {
            $obj = new \ArrayObject();

            foreach ($value as $key => $item) {
                $obj[$key] = $item;
            }

            $value = $obj;
        }
    }

    private function _testGroupBy(array $values, $accessor, array $expected)
    {
        $instance = $this->getInstance($values);

        foreach ($expected as $key => &$values) {
            $values = $this->getInstance($values);
        }

        $this->assertToArray($expected, $instance->groupBy($accessor));
    }

    /**
     * @dataProvider groupByCallableProvider
     */
    public function testGroupByUsingCallable(array $values, callable $accessor, array $expected)
    {
        $this->_testGroupBy($values, $accessor, $expected);
    }

    /**
     * @dataProvider groupByIntegerIndexProvider
     */
    public function testGroupByUsingIntegerIndexOnArrays(array $values, $accessor, array $expected)
    {
        $this->_testGroupBy($values, $accessor, $expected);
    }

    /**
     * @dataProvider groupByIntegerIndexProvider
     */
    public function testGroupByUsingIntegerIndexOnObjects(array $values, $accessor, array $expected)
    {
        $this->transformGroupByForObjects($values);

        foreach ($expected as $i => &$v) {
            $this->transformGroupByForObjects($v);
        }

        $this->_testGroupBy($values, $accessor, $expected);
    }

    /**
     * @dataProvider groupByIntegerIndexProvider
     */
    public function testGroupByUsingIntegerIndexOnArrayAccess(array $values, $accessor, array $expected)
    {
        $this->transformGroupByForArrayAccess($values);

        foreach ($expected as $i => &$v) {
            $this->transformGroupByForArrayAccess($v);
        }

        $this->_testGroupBy($values, $accessor, $expected);
    }

    /**
     * @dataProvider groupByStringIndexProvider
     */
    public function testGroupByUsingStringIndexOnArrays(array $values, $accessor, array $expected)
    {
        $this->_testGroupBy($values, $accessor, $expected);
    }

    /**
     * @dataProvider groupByStringIndexProvider
     */
    public function testGroupByUsingStringIndexOnObjects(array $values, $accessor, array $expected)
    {
        $this->transformGroupByForObjects($values);

        foreach ($expected as $i => &$v) {
            $this->transformGroupByForObjects($v);
        }

        $this->_testGroupBy($values, $accessor, $expected);
    }

    /**
     * @dataProvider groupByStringIndexProvider
     */
    public function testGroupByUsingStringIndexOnArrayAccess(array $values, $accessor, array $expected)
    {
        $this->transformGroupByForArrayAccess($values);

        foreach ($expected as $i => &$v) {
            $this->transformGroupByForArrayAccess($v);
        }

        $this->_testGroupBy($values, $accessor, $expected);
    }

    /**
     * @dataProvider groupByStringIndexProvider
     */
    public function testGroupByFailsUsingBadIndexOnArrays(array $values, $accessor, array $expected)
    {
        $instance = $this->getInstance($values);
        $this->expectUndefinedIndex();
        $instance->groupBy('bad_index');
    }

    /**
     * @dataProvider groupByStringIndexProvider
     */
    public function testGroupByFailsUsingBadIndexOnObjects(array $values, $accessor, array $expected)
    {
        $this->transformGroupByForObjects($values);
        $instance = $this->getInstance($values);
        $this->expectUndefinedIndex();
        $instance->groupBy('bad_index');
    }

    /**
     * @dataProvider groupByStringIndexProvider
     */
    public function testGroupByFailsUsingBadIndexOnArrayAccess(array $values, $accessor, array $expected)
    {
        $this->transformGroupByForArrayAccess($values);
        $instance = $this->getInstance($values);
        $this->expectUndefinedIndex();
        $instance->groupBy('bad_index');
    }

    public function testGroupByOnNonObjectFails()
    {
        $instance = $this->getInstance([1, 2, 3]);
        $this->expectUndefinedIndex();
        $instance->groupBy('some_key');
    }

    public function testGroupByUsesArrayAccessBeforePublicProperty()
    {
        $object = new \ArrayObject();

        // Set both by array access and on the object itself.
        $object['a'] = true;
        $object->a   = false;

        $instance = $this->getInstance([$object]);
        $this->assertEquals(true, $instance->groupBy('a')->first()->key);
    }
}
