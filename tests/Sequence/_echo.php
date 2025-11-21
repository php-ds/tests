<?php
namespace Ds\Tests\Sequence;

trait _echo
{
    public function testEcho()
    {
        $this->assertInstanceToString(static::getInstance());
    }
}
