<?php
namespace Ds\Tests\Queue;

trait _isset
{
    public function testArrayAccessIsset()
    {
        $set = $this->getInstance();
        $this->expectArrayAccessUnsupportedException();
        isset($set['a']);
    }

    public function testArrayAccessIssetByMethod()
    {
        $set = $this->getInstance();
        $this->expectArrayAccessUnsupportedException();
        $set->offsetExists('a');
    }
}
