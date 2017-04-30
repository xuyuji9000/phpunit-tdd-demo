<?php

namespace TestDemo\SimpleDb\Adapter;

use PHPUnit\Framework\TestCase;

class JsonFileTest extends TestCase
{
    protected $object;

    public function setUp()
    {
        $this->object = new JsonFile();
    }


    /**
     * @test
     */
    public function implementsAdapterInterface()
    {
        $this->assertInstanceOf(AdapterInterface::class, $this->object);
    }
}
