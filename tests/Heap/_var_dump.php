<?php
namespace Ds\Tests\Heap;

trait _var_dump
{
    public function testVarDump()
    {
        $instance = $this->getInstance([3, 1, 2]);

        ob_start();
        var_dump($instance);
        $output = ob_get_clean();

        $this->assertStringContainsString('Ds\Heap', $output);
    }
}
