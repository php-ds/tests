<?php
namespace Ds\Tests\Seq;

trait _echo
{
    public function testEcho()
    {
        $this->assertInstanceToString($this->getInstance());
    }
}
