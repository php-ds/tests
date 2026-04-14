<?php
namespace Ds\Tests;

class HeapTest extends CollectionTestCase
{
    use Heap\__construct;
    use Heap\_clone;
    use Heap\_echo;
    use Heap\_empty;
    use Heap\_foreach;
    use Heap\_jsonEncode;
    use Heap\_serialize;
    use Heap\_var_dump;

    use Heap\allocate;
    use Heap\capacity;
    use Heap\clear;
    use Heap\copy;
    use Heap\count;
    use Heap\isEmpty;
    use Heap\peek;
    use Heap\pop;
    use Heap\push;
    use Heap\toArray;

    public function getInstance(array $values = [])
    {
        $heap = new \Ds\Heap();
        foreach ($values as $value) {
            $heap->push($value);
        }
        return $heap;
    }

    /**
     * Override — Heap doesn't preserve insertion order, it sorts by heap property.
     * For max-heap, basicDataProvider should return values in descending order.
     */
    public static function basicDataProvider()
    {
        return [
            [[], []],
            [['a'], ['a']],
            [['a', 'b'], ['b', 'a']],
            [['a', 'b', 'c'], ['c', 'b', 'a']],
            [[3, 1, 2], [3, 2, 1]],
        ];
    }
}
