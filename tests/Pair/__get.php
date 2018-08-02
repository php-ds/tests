<?php
namespace Ds\Tests\Pair;

trait __get
{
    public function testPropertyAccess()
    {
        $pair = $this->getPair('a', 1);

        $this->assertEquals('a', $pair->key);
        $this->assertEquals( 1,  $pair->value);
    }

    public function testBadPropertyAccess()
    {
        $pair = $this->getPair('a', 1);
        $this->expectPropertyDoesNotExistException();
        $pair->nope;
    }

    public function testReflection()
    {
        $pair = $this->getPair('a', 'b');

        $key = new \ReflectionProperty($pair, 'key');
        $val = new \ReflectionProperty($pair, 'value');

        $this->assertEquals('a', $key->getValue($pair));
        $this->assertEquals('b', $val->getValue($pair));

        $class = new \ReflectionClass(\Ds\Pair::class);

        $this->assertCount(2, $class->getProperties());
    }
}
