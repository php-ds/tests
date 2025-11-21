<?php
namespace Ds\Tests\Set;

use PHPUnit\Framework\Attributes\DataProvider;

trait join
{
    public static function joinDataProvider()
    {
        // values, glue
        $data = [];

        $glues   = ['', '~', 1, false];
        $lengths = [0, 1, 2, 3, self::SOME, self::MANY];

        foreach ($lengths as $len) {
            foreach ($glues as $glue) {
                $data[] = [range(0, $len - 1), $glue];
            }
        }

        return $data;
    }

    #[DataProvider('joinDataProvider')]
    public function testJoin(array $values, $glue)
    {
        $instance = static::getInstance($values);
        $expected = join($glue, $values);
        $this->assertEquals($expected, $instance->join($glue));
    }

    #[DataProvider('joinDataProvider')]
    public function testJoinWithoutGlue(array $values, $glue)
    {
        $instance = static::getInstance($values);
        $expected = join($values);
        $this->assertEquals($expected, $instance->join());
    }
}
