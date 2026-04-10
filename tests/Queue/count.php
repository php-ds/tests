<?php
namespace Ds\Tests\Queue;

use PHPUnit\Framework\Attributes\DataProvider;

trait count
{

    #[DataProvider('basicDataProvider')]
    public function testCount(array $values, array $expected)
    {
        $instance = $this->getInstance($values);
        $this->assertCount(count($expected), $instance);
    }

    public function testCountEmpty()
    {
        $instance = $this->getInstance();
        $this->assertCount(0, $instance);
    }
}
