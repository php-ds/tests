<?php
namespace Ds\Tests;

use Ds\Key;

class KeyObject implements Key {

    private $value;
    private $hash;

    public function __construct($value, $hash = null)
    {
        $this->value = $value;
        $this->hash  = func_num_args() === 1 ? $value : $hash;
    }

    public function equals(mixed $obj): bool {
        return $obj->value === $this->value;
    }

    public function hash(): mixed {
        return $this->hash;
    }
}
