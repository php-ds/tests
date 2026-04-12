<?php
namespace Ds\Tests\Seq;

use PHPUnit\Framework\Attributes\DataProvider;

trait _jsonEncode
{
    #[DataProvider('basicDataProvider')]
    public function testJsonEncode(array $values, array $expected)
    {
        $instance = $this->getInstance($values);
        $this->assertEquals(json_encode($expected), json_encode($instance));
    }
}
