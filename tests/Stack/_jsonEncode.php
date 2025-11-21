<?php
namespace Ds\Tests\Stack;

use PHPUnit\Framework\Attributes\DataProvider;

trait _jsonEncode
{
    #[DataProvider('basicDataProvider')]
    public function testJsonEncode(array $initial, array $expected)
    {
        $instance = static::getInstance($initial);
        $this->assertEquals(json_encode($expected), json_encode($instance));
    }
}
