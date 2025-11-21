<?php
namespace Ds\Tests\Map;

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
        $this->assertEquals(json_encode((object) $expected), json_encode($instance));
    }
}
