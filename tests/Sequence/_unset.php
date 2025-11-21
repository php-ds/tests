<?php
namespace Ds\Tests\Sequence;

use PHPUnit\Framework\Attributes\DataProvider;

trait _unset
{
    #[DataProvider('removeDataProvider')]
    public function testArrayAccessUnset($initial, $index, $return, array $expected)
    {
        $instance = static::getInstance($initial);
        unset($instance[$index]);
        $this->assertToArray($expected, $instance);
        $this->assertEquals(count($expected), count($instance));
    }

    #[DataProvider('removeDataProvider')]
    public function testArrayAccessUnsetByMethod($initial, $index, $return, array $expected)
    {
        $instance = static::getInstance($initial);
        $instance->offsetUnset($index);
        $this->assertToArray($expected, $instance);
        $this->assertEquals(count($expected), count($instance));
    }

    #[DataProvider('badIndexDataProvider')]
    public function testArrayAccessUnsetIndexBadIndex($initial, $index)
    {
        $instance = static::getInstance($initial);
        unset($instance[$index]);
        
        $this->assertFalse(isset($instance[$index]));
    }

    #[DataProvider('outOfRangeDataProvider')]
    public function testArrayAccessUnsetIndexOutOfRange($initial, $index)
    {
        $instance = static::getInstance($initial);
        unset($instance[$index]);
        
        $this->assertFalse(isset($instance[$index]));
    }


    public function testArrayAccessUnsetByReference()
    {
        $instance = static::getInstance([[1]]);
        unset($instance[0][0]);

        $this->assertToArray([[]], $instance);
    }
}
