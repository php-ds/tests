<?php
namespace Ds\Tests\Seq;

trait clear
{
    public function testClear()
    {
        $instance = $this->getInstance($this->sample());
        $instance->clear();

        $this->assertToArray([], $instance);
        $this->assertCount(0, $instance);
    }

    public function testClearEmpty()
    {
        $instance = $this->getInstance();
        $instance->clear();

        $this->assertToArray([], $instance);
        $this->assertCount(0, $instance);
    }
}
