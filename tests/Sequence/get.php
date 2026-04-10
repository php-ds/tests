<?php
namespace Ds\Tests\Sequence;

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
        $instance = $this->getInstance($initial);

        $returned = $instance->get($index);

        $this->assertEquals(count($initial), count($instance));
        $this->assertEquals($return, $returned);
    }


    #[DataProvider('outOfRangeDataProvider')]
    public function testGetIndexOutOfRange($initial, $index)
    {
        $instance = $this->getInstance($initial);
        $this->expectIndexOutOfRangeException();
        $instance->get($index);
    }


    #[DataProvider('badIndexDataProvider')]
    public function testGetIndexBadIndex($initial, $index)
    {
        $instance = $this->getInstance();
        $this->expectWrongIndexTypeException();
        $instance->get($index);
    }



    #[DataProvider('getDataProvider')]
    public function testArrayAccessGet(array $initial, $index, $return)
    {
        $instance = $this->getInstance($initial);
        $this->assertEquals($return, $instance[$index]);
    }



    #[DataProvider('badIndexDataProvider')]
    public function testArrayAccessGetIndexBadIndex($initial, $index)
    {
        $instance = $this->getInstance($initial);
        $this->expectWrongIndexTypeException();
        $instance[$index];
    }


    #[DataProvider('outOfRangeDataProvider')]
    public function testArrayAccessGetIndexOutOfRange($initial, $index)
    {
        $instance = $this->getInstance($initial);
        $this->expectIndexOutOfRangeException();
        $instance[$index];
    }


    public function testArrayAccessGetByReference()
    {
        $instance = $this->getInstance([[1]]);
        $this->assertEquals(1, $instance[0][0]);
    }

    public function testArrayAccessGetNullCoalesce()
    {
        $instance = $this->getInstance();

        $this->assertEquals(null, $instance[10] ?? null);
    }
}
