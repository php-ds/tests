<?php
namespace Ds\Tests\Heap;

trait _empty
{
    public function testEmptyCheck()
    {
        $this->assertTrue($this->getInstance([])->isEmpty());
        $this->assertFalse($this->getInstance([1])->isEmpty());
    }
}
