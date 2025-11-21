<?php
namespace Ds\Tests\Set;

trait count
{
    public function testCount()
    {
        list($unique, $duplicates) = self::getUniqueAndDuplicateData();

        $instance = static::getInstance($unique);
        $this->assertCount(count($unique), $instance);

        $instance = static::getInstance($duplicates);
        $this->assertCount(count($unique), $instance);
    }

    public function testCountEmpty()
    {
        $instance = static::getInstance();
        $this->assertCount(0, $instance);
    }
}
