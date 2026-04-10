<?php
namespace Ds\Tests\Set;

use PHPUnit\Framework\Attributes\DataProvider;

trait _foreach
{

    #[DataProvider('basicDataProvider')]
    public function testForEach(array $values, array $expected)
    {
        $instance = $this->getInstance($values);
        $this->assertForEach($expected, $instance);
    }
}
