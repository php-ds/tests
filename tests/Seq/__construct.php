<?php
namespace Ds\Tests\Seq;

trait __construct
{
    public function testConstruct()
    {
        $this->assertToArray([], $this->getInstance());
    }

    public function testConstructWithArray()
    {
        $values = ['a', 'b', 'c'];
        $this->assertToArray($values, $this->getInstance($values));
    }

    public function testConstructWithSelf()
    {
        $values = ['a', 'b', 'c'];
        $instance = $this->getInstance($values);
        $this->assertToArray($values, $this->getInstance($instance->toArray()));
    }
}
