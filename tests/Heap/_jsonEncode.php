<?php
namespace Ds\Tests\Heap;

trait _jsonEncode
{
    public function testJsonEncode()
    {
        $heap = $this->getInstance([3, 1, 2]);
        $json = json_encode($heap);
        $decoded = json_decode($json, true);

        // Should be sorted in heap order (descending for max-heap)
        $this->assertEquals([3, 2, 1], $decoded);
    }

    public function testJsonEncodeEmpty()
    {
        $heap = $this->getInstance([]);
        $this->assertEquals('[]', json_encode($heap));
    }
}
