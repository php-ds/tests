<?php
namespace Ds\Tests;

use Ds\Hashable;

/**
 *
 */
class HashableObject implements Hashable {

    private $value;
    private $hash;

    public function __construct($value, $hash = null)
    {
        $this->value = $value;
        $this->hash  = func_num_args() === 1 ? $value : $hash;
    }

    public function equals($obj): bool {
        return $obj->value === $this->value;
    }

    public function hash() {
        return $this->hash;
    }
}
