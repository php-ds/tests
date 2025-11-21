<?php
namespace Ds\Tests\Sequence;

use PHPUnit\Framework\Attributes\DataProvider;

trait set
{
    public static function setDataProvider()
    {
        // initial, index, value, expected
        return [

            [['a'], 0, 'x', ['x']],

            [['a', 'b'], 0, 'x', ['x', 'b']],
            [['a', 'b'], 1, 'y', ['a', 'y']],

            [['a', 'b', 'c'], 0, 'x', ['x', 'b', 'c']],
            [['a', 'b', 'c'], 1, 'y', ['a', 'y', 'c']],
            [['a', 'b', 'c'], 2, 'z', ['a', 'b', 'z']],
        ];
    }


    #[DataProvider('setDataProvider')]
    public function testSet($initial, $index, $value, array $expected)
    {
        $instance = static::getInstance($initial);

        $instance->set($index, $value);

        $this->assertToArray($expected, $instance);

        // set should not affect count
        $this->assertEquals(count($initial), count($instance));
    }

    #[DataProvider('outOfRangeDataProvider')]
    public function testSetOutOfRange($initial, $index)
    {
        $instance = static::getInstance($initial);
        $this->expectIndexOutOfRangeException();
        $instance->set($index, 1);
    }

    #[DataProvider('badIndexDataProvider')]
    public function testSetIndexBadIndex($initial, $index)
    {
        $instance = static::getInstance();
        $this->expectWrongIndexTypeException();
        $instance->set($index, 1);
    }

    #[DataProvider('setDataProvider')]
    public function testArrayAccessSet($initial, $index, $value, array $expected)
    {
        $instance = static::getInstance($initial);
        $instance[$index] = $value;
        $this->assertToArray($expected, $instance);
        $this->assertEquals(count($expected), count($instance));
    }

    #[DataProvider('badIndexDataProvider')]
    public function testArrayAccessSetIndexBadIndex($initial, $index)
    {
        $instance = static::getInstance($initial);
        $this->expectWrongIndexTypeException();
        $instance[$index] = 1;
    }

    #[DataProvider('outOfRangeDataProvider')]
    public function testArrayAccessSetIndexOutOfRange($initial, $index)
    {
        $instance = static::getInstance($initial);
        $this->expectIndexOutOfRangeException();
        $instance[$index] = 1;
    }


    public function testArrayAccessSetByReference()
    {
        $instance = static::getInstance([[1]]);
        $instance[0][0] = 2;

        $this->assertToArray([[2]], $instance);
    }

    public function testSetWithReference()
    {
        $instance = static::getInstance(['a', 'b', 'c']);

        $key = 1;
        $ref = &$key;

        $instance->set($key, 'B');
        $this->assertEquals('B', $instance->get($key));
        $this->assertEquals('B', $instance->get($ref));

        $instance->set($ref, '#');
        $this->assertEquals('#', $instance->get($key));
        $this->assertEquals('#', $instance->get($ref));

        // Check that the variable that was a reference is still
        $ref++;
        $this->assertEquals(2, $key);
    }

    public function testArrayAccessSetWithReference()
    {
        $instance = static::getInstance(['a', 'b', 'c']);

        $key = 1;
        $ref = &$key;

        $instance[$key] = 'B';
        $this->assertEquals('B', $instance[$key]);
        $this->assertEquals('B', $instance[$ref]);

        $instance[$ref] = '#';
        $this->assertEquals('#', $instance[$key]);
        $this->assertEquals('#', $instance[$ref]);

        // Check that the variable that was a reference is still
        $ref++;
        $this->assertEquals(2, $key);
    }
}
