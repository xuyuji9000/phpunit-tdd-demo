<?php

namespace TestDemo\SimpleDb\Adapter;

use PHPUnit\Framework\TestCase;

class JsonFileTest extends TestCase
{
    protected $object;

    public function setUp()
    {
        $this->object = new JsonFile('/tmp/data.json');
    }


    /**
     * @test
     */
    public function implementsAdapterInterface()
    {
        $this->assertInstanceOf(AdapterInterface::class, $this->object);
    }

    /**
     * @test
     */
    public function canReadJsonData()
    {
        $jsonData = '{"foo": "bar"}';
        file_put_contents('/tmp/data.json', $jsonData);

        $data = $this->object->read();
        $expected = array('foo' => 'bar');
        $this->assertEquals($expected, $data);
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function throwAnExceptionWhenFileDoNotExist()
    {
        $this->object = new JsonFile('/tmp/filedoesnotexist');
    }
}
