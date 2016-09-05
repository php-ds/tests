<?php
namespace Ds\Tests\Sequence;

trait swap
{
    public function swapDataProvider()
    {
        return [
            [['a', 'b', 'c'], 0, 1, ['b', 'a', 'c']],
            [['a', 'b', 'c'], 1, 0, ['b', 'a', 'c']],

            [['a', 'b', 'c'], 1, 2, ['a', 'c', 'b']],
            [['a', 'b', 'c'], 2, 1, ['a', 'c', 'b']],

            [['a', 'b', 'c'], 0, 2, ['c', 'b', 'a']],
            [['a', 'b', 'c'], 2, 0, ['c', 'b', 'a']],
        ];
    }

    /**
     * @dataProvider swapDataProvider
     */
    public function testSwap(array $values, int $a, int $b, array $expected)
    {
        $instance = $this->getInstance($values);
        $instance->swap($a, $b);
        $this->assertToArray($expected, $instance);
    }

    public function testSwapLeftIndexNegative()
    {
        $instance = $this->getInstance(['a', 'b', 'c']);
        $this->expectIndexOutOfRangeException();
        $instance->swap(-1, 1);
    }

    public function testSwapLeftIndexTooLarge()
    {
        $instance = $this->getInstance(['a', 'b', 'c']);
        $this->expectIndexOutOfRangeException();
        $instance->swap(3, 1);
    }

    public function testSwapRightIndexNegative()
    {
        $instance = $this->getInstance(['a', 'b', 'c']);
        $this->expectIndexOutOfRangeException();
        $instance->swap(1, -1);
    }

    public function testSwapRightIndexTooLarge()
    {
        $instance = $this->getInstance(['a', 'b', 'c']);
        $this->expectIndexOutOfRangeException();
        $instance->swap(1, 3);
    }

    public function testSwapSameIndex()
    {
        $instance = $this->getInstance(['a', 'b', 'c']);

        $instance->swap(0, 0);
        $this->assertToArray(['a', 'b', 'c'], $instance);

        $instance->swap(1, 1);
        $this->assertToArray(['a', 'b', 'c'], $instance);

        $instance->swap(2, 2);
        $this->assertToArray(['a', 'b', 'c'], $instance);
    }

    public function testSwapReverse()
    {
        $instance = $this->getInstance(range(1, self::MANY));

        for ($i = 0; $i < self::MANY / 2; $i++) {
            $instance->swap($i, self::MANY - $i - 1);
        }

        $this->assertToArray(array_reverse(range(1, self::MANY)), $instance);
    }

    public function testSwapDoubleReverse()
    {
        $instance = $this->getInstance(range(1, self::MANY));

        for ($i = 0; $i < self::MANY; $i++) {
            $instance->swap($i, self::MANY - $i - 1);
        }

        $this->assertToArray(range(1, self::MANY), $instance);
    }
}
