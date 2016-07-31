<?php
namespace Ds\Tests\Sequence;

trait sorted
{
    public function testSorted()
    {
        $instance = $this->getInstance([4, 1, 2, 5, 3]);
        $sorted = $instance->sorted();

        $this->assertToArray([1, 2, 3, 4, 5], $sorted);
        $this->assertToArray([4, 1, 2, 5, 3], $instance);
    }

    public function testSortedUsingComparator()
    {
        $instance = $this->getInstance([4, 1, 2, 5, 3]);

        $sorted = $instance->sorted(function($a, $b) {
            return $b <=> $a;
        });

        $this->assertToArray([5, 4, 3, 2, 1], $sorted);
        $this->assertToArray([4, 1, 2, 5, 3], $instance);
    }
}
