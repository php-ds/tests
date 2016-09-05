<?php
namespace Ds\Tests\Sequence;

trait shuffle
{
    public function testShuffle()
    {
        $instance = $this->getInstance(range(0, self::MANY));
        $instance->shuffle();

        $this->assertToArray(range(0, self::MANY), $instance->sorted());

        foreach ($instance as $index => $value) {
            if ($index !== $value) {
                return true;
            }
        }
    }
}
