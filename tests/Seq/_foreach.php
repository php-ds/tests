<?php
namespace Ds\Tests\Seq;

use PHPUnit\Framework\Attributes\DataProvider;

trait _foreach
{
    #[DataProvider('basicDataProvider')]
    public function testForEach(array $values, array $expected)
    {
        $this->assertForEach($expected, $this->getInstance($values));
    }
}
