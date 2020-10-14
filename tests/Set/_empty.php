<?php
namespace Ds\Tests\Set;

trait _empty
{
    public function testArrayAccessEmpty()
    {
        $set = $this->getInstance(['a', 'b', 'c']);
        $this->expectArrayAccessUnsupportedException();
        empty($set[0]);
    }
}
