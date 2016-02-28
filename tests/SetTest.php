<?php
namespace Ds\Tests;

class SetTest extends CollectionTest
{
    use Set\__construct;
    use Set\_clone;
    use Set\_echo;
    use Set\_empty;
    use Set\_foreach;
    use Set\_isset;
    use Set\_jsonEncode;
    use Set\_list;
    use Set\_serialize;
    use Set\_unset;
    use Set\_var_dump;

    use Set\add;
    use Set\addAll;
    use Set\allocate;
    use Set\capacity;
    use Set\clear;
    use Set\contains;
    use Set\copy;
    use Set\count;
    use Set\diff;
    use Set\filter;
    use Set\first;
    use Set\get;
    use Set\intersect;
    use Set\isEmpty;
    use Set\join;
    use Set\last;
    use Set\reduce;
    use Set\remove;
    use Set\removeAll;
    use Set\reverse;
    use Set\slice;
    use Set\sort;
    use Set\toArray;
    use Set\union;
    use Set\xor;

    protected function getInstance(array $values = [])
    {
        return new \Ds\Set($values);
    }

    public function getUniqueAndDuplicateData()
    {
        $sample     = $this->sample();
        $duplicates = [];

        foreach ($sample as $value) {
            $duplicates[] = $value;
            $duplicates[] = $value;
        }

        $sample[] = new HashableObject(1);

        $duplicates[] = new HashableObject(1);
        $duplicates[] = new HashableObject(1);

        return [$sample, $duplicates];
    }

    public function testArrayAccessSet() {
        $set = $this->getInstance();
        $this->expectOutOfBoundsException();
        $set['a'] = 1;
    }
}
