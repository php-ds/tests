<?php
namespace Ds\Tests\Sequence;

use PHPUnit\Framework\Attributes\DataProvider;

trait join
{
    public static function joinDataProvider()
    {
        // values, glue
        $data = [];

        $glues   = ['', '~', 0, 1, false];
        $lengths = [0, 1, 2, 3, 10];
        $obj     = static::getInstance();

        foreach ($lengths as $length) {
            foreach ($glues as $glue) {
                $data[] = [range(1, $length),            $glue]; // integers
                $data[] = [array_fill(0, $length, 'x'),  $glue]; // string
                $data[] = [array_fill(0, $length, $obj), $glue]; // objects
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
