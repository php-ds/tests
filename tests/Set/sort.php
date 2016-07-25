<?php
namespace Ds\Tests\Set;

trait sort
{
    public function testSort()
    {
        $instance = $this->getInstance([4, 1, 2, 5, 3]);

        $instance->sort();
        $this->assertToArray([1, 2, 3, 4, 5], $instance);
    }

    public function testSortUsingComparator()
    {
        $instance = $this->getInstance([4, 1, 2, 5, 3]);

        $instance->sort(function($a, $b) {
            return $b <=> $a;
        });

        $this->assertToArray([5, 4, 3, 2, 1], $instance);
    }
}
