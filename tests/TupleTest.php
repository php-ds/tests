<?php
namespace Ds\Tests;

use Ds\Tuple;

class TupleTest extends CollectionTest
{

    public function getInstance(array $values = [])
    {
        return new \Ds\Tuple($values);
    }
}
