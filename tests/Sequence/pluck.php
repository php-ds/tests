<?php
namespace Ds\Tests\Sequence;

class MagicGetter
{
    private $values;
    public function __construct(array $values)
    {
        $this->values = $values;
    }
    public function __get($offset) {
        return $this->values[$offset];
    }
}

trait pluck
{
    public function pluckDataProvider()
    {
        // values, key
        return [
            [[],                    'a'],
            [ range(1, 1),          'a'],
            [ range(1, 2),          'a'],
            [ range(1, 3),          'a'],
            [ range(1, self::SOME), 'a'],
            [ range(1, self::MANY), 'a'],

            [[],                      1],
            [ range(1, 1),            1],
            [ range(1, 2),            1],
            [ range(1, 3),            1],
            [ range(1, self::SOME),   1],
            [ range(1, self::MANY),   1],

            [[],                    '1'],
            [ range(1, 1),          '1'],
            [ range(1, 2),          '1'],
            [ range(1, 3),          '1'],
            [ range(1, self::SOME), '1'],
            [ range(1, self::MANY), '1'],
        ];
    }

    private function _testPluck(array $values, $key, callable $generator)
    {
        $instance = $this->getInstance();

        foreach ($values as $value) {
            $instance[] = $generator($key, $value);
        }

        $this->assertToArray($values, $instance->pluck($key));
    }

    /**
     * @dataProvider pluckDataProvider
     */
    public function testPluckOnArrays(array $values, $key)
    {
        $this->_testPluck($values, $key, function($key, $value) {
            return [$key => $value];
        });
    }

    /**
     * @dataProvider pluckDataProvider
     */
    public function testPluckOnArrayAccessObject(array $values, $key)
    {
        $this->_testPluck($values, $key, function($key, $value) {
            $obj = new \ArrayObject();
            $obj[$key] = $value;
            return $obj;
        });
    }

    /**
     * @dataProvider pluckDataProvider
     */
    public function testPluckOnObject(array $values, $key)
    {
        $this->_testPluck($values, $key, function($key, $value) {
            $object = new \stdClass();
            $object->$key = $value;
            return $object;
        });
    }

    public function testPluckFailsOnBadKeyInArray()
    {
        $instance = $this->getInstance([
            ['a' => 1],
            ['b' => 2],
        ]);

        $this->expectUndefinedIndex();
        $instance->pluck('a');
    }

    public function testPluckFailsOnBadKeyInArrayAccessObject()
    {
        $a = new \ArrayObject();
        $b = new \ArrayObject();

        $a['a'] = 1;
        $b['b'] = 2; // b doesn't have an 'a' property

        $instance = $this->getInstance([$a, $b]);

        $this->expectUndefinedIndex();
        $instance->pluck('a');
    }

    public function testPluckFailsOnBadKeyInObject()
    {
        $a = new \stdClass();
        $b = new \stdClass();

        $a->a = 1;
        $b->b = 1; // b doesn't have an 'a' property

        $instance = $this->getInstance([$a, $b]);

        $this->expectUndefinedIndex();
        $instance->pluck('a');
    }

    public function testPluckOnStrings()
    {
        $a = "abc";
        $b = "xyz";

        $instance = $this->getInstance([$a, $b]);
        $this->assertToArray(['b', 'y'], $instance->pluck(1));
    }

    public function testPluckUsingMagicGet()
    {
        $a = new MagicGetter([0, 1, 2]);
        $b = new MagicGetter([3, 4, 5]);
        $c = new MagicGetter([6, 7, 8]);

        $instance = $this->getInstance([$a, $b, $c]);
        $this->assertToArray([1, 4, 7], $instance->pluck(1));
    }
}
