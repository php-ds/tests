<?php
namespace Ds\Tests\Sequence;

use PHPUnit\Framework\Attributes\DataProvider;

trait _jsonEncode
{
    public static function jsonEncodeDataProvider()
    {
        return self::basicDataProvider();
    }

    #[DataProvider('jsonEncodeDataProvider')]
    public function testJsonEncode(array $initial, array $expected)
    {
        $instance = static::getInstance($initial);
        $this->assertEquals(json_encode($expected), json_encode($instance));
    }
}
