<?php
namespace Ds\Tests;

use ArrayAccess;

class SeqTest extends CollectionTestCase
{
    use Seq\__construct;
    use Seq\_clone;
    use Seq\_echo;
    use Seq\_empty;
    use Seq\_foreach;
    use Seq\_isset;
    use Seq\_jsonEncode;
    use Seq\_list;
    use Seq\_serialize;
    use Seq\_unset;
    use Seq\_var_dump;

    use Seq\allocate;
    use Seq\apply;
    use Seq\capacity;
    use Seq\clear;
    use Seq\contains;
    use Seq\copy;
    use Seq\count;
    use Seq\filter;
    use Seq\find;
    use Seq\first;
    use Seq\get;
    use Seq\insert;
    use Seq\isEmpty;
    use Seq\join;
    use Seq\last;
    use Seq\map;
    use Seq\merge;
    use Seq\pop;
    use Seq\push;
    use Seq\reduce;
    use Seq\remove;
    use Seq\reverse;
    use Seq\reversed;
    use Seq\rotate;
    use Seq\set;
    use Seq\shift;
    use Seq\slice;
    use Seq\sort;
    use Seq\sorted;
    use Seq\sum;
    use Seq\toArray;
    use Seq\unshift;

    public function getInstance(array $values = [])
    {
        return new \Ds\Seq($values);
    }

    public function testImplementsArrayAccess()
    {
        $this->assertInstanceOf(ArrayAccess::class, $this->getInstance());
    }
}
