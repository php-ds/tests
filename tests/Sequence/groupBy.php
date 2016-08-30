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

    private function transformGroupByForObjects(array $values)
    {
        foreach ($values as $index => $value) {
            $obj = new \stdClass();

            foreach ($value as $key => $property) {
                $obj->$key = $property;
            }

            $values[$index] = $obj;
        }

        return $values;
    }

    private function transformGroupByForArrayAccess(array $values)
    {
        foreach ($values as $index => $value) {
            $values[$index] = new \ArrayObject($value);
        }

        return $values;
    }

    private function _testGroupBy(array $values, $accessor, array $expected)
    {
        $instance = $this->getInstance($values);

        foreach ($expected as $key => $values) {
            $expected[$key] = $this->getInstance($values);
        }

        $this->assertEquals($expected, $instance->groupBy($accessor)->toArray());
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
        $values = $this->transformGroupByForObjects($values);
        $expected = array_map([$this, 'transformGroupByForObjects'], $expected);
        $this->_testGroupBy($values, $accessor, $expected);
    }

    /**
     * @dataProvider groupByIntegerIndexProvider
     */
    public function testGroupByUsingIntegerIndexOnArrayAccess(array $values, $accessor, array $expected)
    {
        $values = $this->transformGroupByForArrayAccess($values);
        $expected = array_map([$this, 'transformGroupByForArrayAccess'], $expected);
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
        $values = $this->transformGroupByForObjects($values);
        $expected = array_map([$this, 'transformGroupByForObjects'], $expected);
        $this->_testGroupBy($values, $accessor, $expected);
    }

    /**
     * @dataProvider groupByStringIndexProvider
     */
    public function testGroupByUsingStringIndexOnArrayAccess(array $values, $accessor, array $expected)
    {
        $values = $this->transformGroupByForArrayAccess($values);
        $expected = array_map([$this, 'transformGroupByForArrayAccess'], $expected);
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
        $values = $this->transformGroupByForObjects($values);
        $instance = $this->getInstance($values);
        $this->expectUndefinedIndex();
        $instance->groupBy('bad_index');
    }

    /**
     * @dataProvider groupByStringIndexProvider
     */
    public function testGroupByFailsUsingBadIndexOnArrayAccess(array $values, $accessor, array $expected)
    {
        $values = $this->transformGroupByForArrayAccess($values);
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

    public function testGroupByCallbackThrowsException()
    {
        $instance = $this->getInstance([
            ['a' => 1],
            ['a' => 2],
            ['a' => 3],
        ]);

        $grouped = null;

        try {
            $grouped = $instance->groupBy(function($value) {
                if ($value['a'] === 3) {
                    throw new \Exception();
                }
                return $value['a'];
            });
        } catch (\Exception $e) {
            $this->assertNull($grouped);
            return;
        }

        $this->fail('Exception should have been caught');
    }
}
