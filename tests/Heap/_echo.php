<?php
namespace Ds\Tests\Heap;

trait _echo
{
    public function testEcho()
    {
        $this->assertInstanceToString($this->getInstance());
    }
}
