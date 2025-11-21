<?php
namespace Ds\Tests\Set;

use PHPUnit\Framework\Attributes\DataProvider;

trait get
{
    public static function getDataProvider()
    {
        // initial, index, return
        return [

            [[0], 0, 0],

            [['a'], 0, 'a'],

            [['a', 'b'], 0, 'a'],
            [['a', 'b'], 1, 'b'],

            [['a', 'b', 'c'], 0, 'a'],
            [['a', 'b', 'c'], 1, 'b'],
            [['a', 'b', 'c'], 2, 'c'],
        ];
    }

    #[DataProvider('getDataProvider')]
    public function testGet(array $initial, $index, $return)
    {
        $instance = static::getInstance($initial);

        $returned = $instance->get($index);

        $this->assertEquals(count($initial), count($instance));
        $this->assertEquals($return, $returned);
    }

    #[DataProvider('outOfRangeDataProvider')]
    public function testGetIndexOutOfRange($initial, $index)
    {
        $instance = static::getInstance($initial);
        $this->expectIndexOutOfRangeException();
        $instance->get($index);
    }

    #[DataProvider('badIndexDataProvider')]
    public function testGetIndexBadIndex($initial, $index)
    {
        $instance = static::getInstance();
        $this->expectWrongIndexTypeException();
        $instance->get($index);
    }

    #[DataProvider('getDataProvider')]
    public function testArrayAccessGet(array $initial, $index, $return)
    {
        $instance = static::getInstance($initial);
        $this->assertEquals($return, $instance[$index]);
    }

    #[DataProvider('getDataProvider')]
    public function testArrayAccessGetByMethod(array $initial, $index, $return)
    {
        $instance = static::getInstance($initial);
        $this->assertEquals($return, $instance->offsetGet($index));
    }

    #[DataProvider('badIndexDataProvider')]
    public function testArrayAccessGetIndexBadIndex($initial, $index)
    {
        $instance = static::getInstance($initial);
        $this->expectWrongIndexTypeException();
        $instance[$index];
    }

    #[DataProvider('outOfRangeDataProvider')]
    public function testArrayAccessGetIndexOutOfRange($initial, $index)
    {
        $instance = static::getInstance($initial);
        $this->expectIndexOutOfRangeException();
        $instance[$index];
    }

    public function testGetFirstAfterRemove()
    {
        $instance = static::getInstance();

        $instance->add('a', 'b', 'c');
        $this->assertEquals('a', $instance->get(0));

        $instance->remove('a');
        $this->assertEquals('b', $instance->get(0));

        $instance->remove('b');
        $this->assertEquals('c', $instance->get(0));
    }

    public function testGetLastAfterRemove()
    {
        $instance = static::getInstance();

        $instance->add('a', 'b', 'c');
        $this->assertEquals('c', $instance->get(2));

        $instance->remove('c');
        $this->assertEquals('b', $instance->get(1));

        $instance->remove('b');
        $this->assertEquals('a', $instance->get(0));
    }

    public static function getAfterRemoveProvider()
    {
        // values, value to remove, get index, expected result
        return [
            [['a', 'b', 'c'], 'a', 0, 'b'],
            [['a', 'b', 'c'], 'a', 1, 'c'],

            [['a', 'b', 'c'], 'b', 0, 'a'],
            [['a', 'b', 'c'], 'b', 1, 'c'],

            [['a', 'b', 'c'], 'c', 0, 'a'],
            [['a', 'b', 'c'], 'c', 1, 'b'],
        ];
    }

    #[DataProvider('getAfterRemoveProvider')]
    public function testGetAfterRemove(array $values, $remove, $index, $expected)
    {
        $instance = static::getInstance($values);
        $instance->remove($remove);

        $this->assertEquals($expected, $instance->get($index));
    }

    public function testGetAfterRemoveAtTheStart()
    {
        $instance = static::getInstance(['a', 'b', 'c', 'd', 'e']);

        $instance->remove('a');
        $this->assertEquals('b', $instance->get(0));
        $this->assertEquals('c', $instance->get(1));
        $this->assertEquals('d', $instance->get(2));
        $this->assertEquals('e', $instance->get(3));

        $instance->remove('b');
        $this->assertEquals('c', $instance->get(0));
        $this->assertEquals('d', $instance->get(1));
        $this->assertEquals('e', $instance->get(2));

        $instance->remove('c');
        $this->assertEquals('d', $instance->get(0));
        $this->assertEquals('e', $instance->get(1));

        $instance->remove('d');
        $this->assertEquals('e', $instance->get(0));

        $instance->remove('e');
        $this->assertTrue($instance->isEmpty());
    }

    public function testGetAfterRemoveAtTheEnd()
    {
        $instance = static::getInstance(['a', 'b', 'c', 'd', 'e']);

        $instance->remove('e');
        $this->assertEquals('a', $instance->get(0));
        $this->assertEquals('b', $instance->get(1));
        $this->assertEquals('c', $instance->get(2));
        $this->assertEquals('d', $instance->get(3));

        $instance->remove('d');
        $this->assertEquals('a', $instance->get(0));
        $this->assertEquals('b', $instance->get(1));
        $this->assertEquals('c', $instance->get(2));

        $instance->remove('c');
        $this->assertEquals('a', $instance->get(0));
        $this->assertEquals('b', $instance->get(1));

        $instance->remove('b');
        $this->assertEquals('a', $instance->get(0));

        $instance->remove('a');
        $this->assertTrue($instance->isEmpty());
    }

    public function testGetAfterMultipleRemoveAtEitherEnd()
    {
        $instance = static::getInstance(['a', 'b', 'c', 'd', 'e']);

        $instance->remove('a');
        $this->assertEquals('b', $instance->get(0));
        $this->assertEquals('c', $instance->get(1));
        $this->assertEquals('d', $instance->get(2));
        $this->assertEquals('e', $instance->get(3));

        $instance->remove('e');
        $this->assertEquals('b', $instance->get(0));
        $this->assertEquals('c', $instance->get(1));
        $this->assertEquals('d', $instance->get(2));

        $instance->remove('b');
        $this->assertEquals('c', $instance->get(0));
        $this->assertEquals('d', $instance->get(1));

        $instance->remove('d');
        $this->assertEquals('c', $instance->get(0));

        $instance->remove('c');
        $this->assertTrue($instance->isEmpty());
    }
}
