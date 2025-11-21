<?php
namespace Ds\Tests\Map;

trait toArray
{
    public function testToArrayWithBadKey()
    {
        $instance = static::getInstance();
        $instance->put(new \stdClass(), 1);

        $this->expectInternalIllegalOffset();
        $instance->toArray();
    }
}
