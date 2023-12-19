<?php
namespace Ds\Tests;

use ArrayAccess;

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
    use Set\map;
    use Set\merge;
    use Set\reduce;
    use Set\remove;
    use Set\reverse;
    use Set\reversed;
    use Set\slice;
    use Set\sort;
    use Set\sorted;
    use Set\sum;
    use Set\toArray;
    use Set\union;
    use Set\xor_;

    public function getInstance(array $values = [])
    {
        return new \Ds\Set($values);
    }

    public function getUniqueAndDuplicateData()
    {
        $sample = $this->sample();
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

    public function testArrayAccessSet()
    {
        $set = $this->getInstance();
        $this->expectArrayAccessUnsupportedException();
        $set['a'] = 1;
    }

    public function testImplementsArrayAccess()
    {
        $this->assertInstanceOf(ArrayAccess::class, $this->getInstance());
    }

    /**
     * @see https://github.com/php-ds/ext-ds/issues/193
     */
    public function testIssue193()
    {
        $data = [
            [
                'id' => 1,
                'data' => 'test',
            ],
            [
                'id' => 2,
                'data' => 'test',
            ]
        ];
        foreach ($data as &$item) {
            unset($item['id']);
        }
        $set = new \Ds\Set($data);
        static::assertEquals([['data' => 'test']], $set->toArray());
    }
}
