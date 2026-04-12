<?php
namespace Ds\Tests\Seq;

trait _empty
{
    public function testEmptyCheck()
    {
        $this->assertTrue($this->getInstance([])->isEmpty());
        $this->assertFalse($this->getInstance(['a'])->isEmpty());
    }

    public function testArrayAccessEmpty()
    {
        $instance = $this->getInstance([0, 1, false, null]);

        $this->assertTrue(empty($instance[0]));   // 0 is empty
        $this->assertFalse(empty($instance[1]));   // 1 is not empty
        $this->assertTrue(empty($instance[2]));    // false is empty
        $this->assertTrue(empty($instance[3]));    // null is empty
    }
}
