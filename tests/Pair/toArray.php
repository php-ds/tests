<?php
namespace Ds\Tests\Pair;

trait toArray
{
    public function testToArray()
    {
        $instance = $this->getPair('a', 1);
        $expected = [
            'key'   => 'a',
            'value' => 1
        ];

        $this->assertEquals($expected, $instance->toArray());
    }
}
