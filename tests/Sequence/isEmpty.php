<?php
namespace Ds\Tests\Sequence;

use PHPUnit\Framework\Attributes\DataProvider;

trait isEmpty
{
    public static function isEmptyDataProvider()
    {
        // values, is empty
        return [
            [[],         true],
            [['a'],     false],
        ];
    }

    #[DataProvider('isEmptyDataProvider')]
    public function testIsEmpty(array $values, bool $isEmpty)
    {
        $instance = static::getInstance($values);
        $this->assertEquals($isEmpty, $instance->isEmpty());
    }

    public function testIsNotEmptyAfterRemove()
    {
        $instance = static::getInstance();
        $this->assertTrue($instance->isEmpty());

        $instance->push('a');
        $this->assertFalse($instance->isEmpty());

        $instance->remove(0);
        $this->assertTrue($instance->isEmpty());
    }
}
