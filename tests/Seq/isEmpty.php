<?php
namespace Ds\Tests\Seq;

use PHPUnit\Framework\Attributes\DataProvider;

trait isEmpty
{
    public static function isEmptyDataProvider()
    {
        // values, is empty
        return [
            [[],        true],
            [['a'],     false],
        ];
    }


    #[DataProvider('isEmptyDataProvider')]
    public function testIsEmpty(array $values, bool $isEmpty)
    {
        $instance = $this->getInstance($values);
        $this->assertEquals($isEmpty, $instance->isEmpty());
    }

    public function testIsNotEmptyAfterPush()
    {
        $instance = $this->getInstance();
        $this->assertTrue($instance->isEmpty());

        $instance->push('a');
        $this->assertFalse($instance->isEmpty());
    }

    public function testIsEmptyAfterPop()
    {
        $instance = $this->getInstance(['a']);
        $instance->pop();
        $this->assertTrue($instance->isEmpty());
    }
}
