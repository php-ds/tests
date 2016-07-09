<?php
namespace Ds\Tests\PriorityQueue;

use Ds\PriorityQueue;

trait __construct
{
    public function testConstruct()
    {
        $this->assertToArray([], new PriorityQueue());
    }
}
