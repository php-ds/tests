<?php
namespace Ds\Tests\Set;

use PHPUnit\Framework\Attributes\DataProvider;

use Ds\Set;

trait __construct
{
    public static function constructDataProvider()
    {
        list($unique, $duplicated) = self::getUniqueAndDuplicateData();

        return [
            [[],            []],
            [['a'],         ['a']],
            [['a', 'a'],    ['a']],
            [['a', 'b'],    ['a', 'b']],
            [$unique,       $unique],
            [$duplicated,   $unique],
        ];
    }

    #[DataProvider('constructDataProvider')]
    public function testConstruct(array $values, array $expected)
    {
        $this->assertToArray($expected, new Set($values));
    }

    #[DataProvider('constructDataProvider')]
    public function testConstructUsingIterable(array $values, array $expected)
    {
        $this->assertToArray($expected, new Set(new \ArrayIterator($values)));
    }

    public function testConstructNoParams()
    {
        $this->assertToArray([], new Set());
    }
}
