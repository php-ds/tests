<?php
namespace Ds\Tests\Map;

use PHPUnit\Framework\Attributes\DataProvider;

trait _serialize
{

    #[DataProvider('basicDataProvider')]
    public function testSerialize(array $values, array $expected)
    {
        $instance = $this->getInstance($values);
        $this->assertSerialized($expected, $instance, true);
    }
}
