<?php
namespace Ds\Tests\Sequence;

trait each
{
    public function testEach()
    {
        $instance = $this->getInstance(['a', 'b', 'c']);
        $string   = "";

        $completed = $instance->each(function($value) use (&$string) {
            $string .= $value;
        });

        $this->assertTrue($completed);
        $this->assertEquals("abc", $string);
    }

    public function testEachExit()
    {
        $instance = $this->getInstance(['a', 'b', 'c']);
        $string   = "";

        $completed = $instance->each(function($value) use (&$string) {
            if ($value === 'c') {
                return false;
            }

            $string .= $value;
        });

        $this->assertFalse($completed);
        $this->assertEquals("ab", $string);
    }

    // public function testEachByReferenceDoesNotUpdateValue()
    // {
    //     $instance = $this->getInstance(['a', 'b', 'c']);

    //     $instance->each(function(&$value) {
    //         $value = null;
    //     });

    //     $this->assertToArray(['a', 'b', 'c'], $instance);
    // }
}
