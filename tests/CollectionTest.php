<?php
namespace Ds\Tests;

use Ds\Collection;
use PHPUnit_Framework_TestCase;

abstract class CollectionTest extends PHPUnit_Framework_TestCase
{
    /**
     * Sample sizes.
     */
    const MANY = 65;
    const SOME = 17;

    /**
     * Generic mixed value sample array.
     */
    public function sample()
    {
        return array_merge(
            [[]],                               // empty
            [['a']],                            // 1 value
            [['a', 'b']],                       // 2 values
            [['a', 'b', 'c']],                  // 3 values
            ['#', '1', 1, 1.0, true],           // == true
            ['',  '0', 0, 0.0, false, null],    // == false
            ['a', 'A', new \stdClass()],        // string cases, stdClass
            range(2, self::SOME)
        );
    }

    /**
     * @return a basic data provider providing two equal values for each test.
     */
    public function basicDataProvider()
    {
        $values = [
            [],
            ['a'],
            ['a', 'b'],
            ['a', 'b', 'c'],
            $this->sample(),
        ];

        return array_map(function($a) { return [$a, $a]; }, $values);
    }

    /**
     * @return a data provider for Sequence and Set to test out of range indexes.
     */
    public function outOfRangeDataProvider()
    {
        return [
            [[ ], -1],
            [[ ],  1],
            [[1],  2],
            [[1], -1],
        ];
    }

    public function badIndexDataProvider()
    {
        return [
            [[], 'a'],
        ];
    }

    public function assertInstanceToString($instance)
    {
        $this->assertEquals("object(" . get_class($instance) . ')', "$instance");
    }

    public function assertToArray(array $expected, $instance)
    {
        $actual = $instance->toArray();

        // We have to make separate assertions here because PHPUnit considers an
        // array to be equal if the keys match the values even if the order is
        // not the same, ie. [a => 1, b => 2] equals [b => 2, a => 1].
        $this->assertEquals(array_values($expected), array_values($actual), "!!! ARRAY VALUE MISMATCH");
        $this->assertEquals(array_keys  ($expected), array_keys  ($actual), "!!! ARRAY KEY MISMATCH");
    }

    public function expectAccessByReferenceHasNoEffect()
    {
        $this->setExpectedException(\PHPUnit_Framework_Error_Notice::class);
    }

    public function expectPropertyDoesNotExistException()
    {
        $this->setExpectedException(\OutOfBoundsException::class);
    }

    public function expectReconstructionNotAllowedException()
    {
        $this->setExpectedException('Error');
    }

    public function expectImmutableException()
    {
        $this->setExpectedException('Error');
    }

    public function expectAccessByReferenceNotAllowedException()
    {
        $this->setExpectedException('Error');
    }

    public function expectListNotSupportedException()
    {
        $this->setExpectedException('Error');
    }

    public function expectIterateByReferenceException()
    {
        $this->setExpectedException('Error');
    }

    public function expectWrongIndexTypeException()
    {
        $this->setExpectedException('TypeError');
    }

    public function expectOutOfBoundsException()
    {
        $this->setExpectedException(\OutOfBoundsException::class);
    }

    public function expectArrayAccessUnsupportedException()
    {
        $this->setExpectedException('Error');
    }

    public function expectKeyNotFoundException()
    {
        $this->setExpectedException(\OutOfBoundsException::class);
    }

    public function expectIndexOutOfRangeException()
    {
        $this->setExpectedException(\OutOfRangeException::class);
    }

    public function expectEmptyNotAllowedException()
    {
        $this->setExpectedException(\UnderflowException::class);
    }

    public function expectNotIterableOrArrayException()
    {
        $this->setExpectedException('TypeError');
    }

    public function expectInternalIllegalOffset()
    {
        $this->setExpectedException(\PHPUnit_Framework_Error_Warning::class);
    }

    public function assertInstanceDump(array $expected, $instance)
    {
        ob_start();
        $this->cleanVarDump($instance);
        $actual = ob_get_clean();

        ob_start();
        $this->cleanVarDump($expected);
        $expected = ob_get_clean();

        $class = preg_quote(get_class($instance));
        $data  = preg_quote(substr($expected, 5)); // Slice past 'array'
        $regex = preg_replace('/#\d+/', '#\d+', "object\($class\)#\d+ $data");

        $this->assertRegExp("~$regex~", $actual);

    }

    public function assertSerialized(array $expected, $instance)
    {
        $unserialized = unserialize(serialize($instance));

        // Check that the instance is an instance of the correct class and that
        // its values reflect the original values.
        $this->assertEquals(get_class($instance), get_class($unserialized));
        $this->assertEquals($instance->toArray(), $unserialized->toArray());
        $this->assertTrue($instance !== $unserialized);
    }

    public function assertForEach(array $expected, $instance)
    {
        $data = [];

        foreach ($instance as $key => $value) {
            $data[$key] = $value;
        }

        $this->assertEquals($expected, $data);

        /**
         * @see https://github.com/php-ds/extension/issues/82
         */
        $producer = new Producer($this);
        $iterated = [];

        foreach ($producer->getInstance($expected) as $key => $value) {
            $iterated[$key] = $value;
        }

        $this->assertEquals($expected, $iterated);
    }

    public function assertForEachByReferenceThrowsException($instance)
    {
        $this->expectIterateByReferenceException();
        foreach ($instance as &$value);
    }

    /**
     * Perform a clean var dump disabling xdebug overload if set.
     *
     * @param mixed $expression
     */
    protected function cleanVarDump($expression)
    {
        $overload_var_dump = ini_get('xdebug.overload_var_dump');
        ini_set('xdebug.overload_var_dump', 'off');
        var_dump($expression);
        ini_set('xdebug.overload_var_dump', $overload_var_dump);
    }

    /**
     * @see https://github.com/php-ds/extension/issues/62
     */
    public function testConvertingToBoolean()
    {
        $instance = $this->getInstance();
        $this->assertTrue((bool) $instance);
    }
}

/**
 * @internal
 * @see assertForEach
 * @see https://github.com/php-ds/extension/issues/82
 */
class Producer {

    private $test;

    public function __construct($test) {
        $this->test = $test;
    }

    public function getInstance(array $values = null)
    {
        return $this->test->getInstance($values);
    }
}

