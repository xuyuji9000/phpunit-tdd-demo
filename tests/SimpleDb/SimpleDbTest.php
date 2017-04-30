<?php

namespace TestDemo\SimpleDb;

use PHPUnit\Framework\TestCase;


class SimpleDbTest extends TestCase
{
    /** @var SimpleDb **/
    protected $db;

    /** 
     * @var Adapter\AdapterInterface
     */
    protected $adapter;

    public function setUp()
    {
        $this->adapter = $this->createMock(Adapter\AdapterInterface::class);
        $this->db = new SimpleDb($this->adapter);
    }

    /**
     * @test
     */
    public function returnEmptyArrayWhenNoRecordExists()
    {
        $this->adapter->expects($this->once())
            ->method('read')
            ->will($this->returnValue([]));
        $returnValue = $this->db->findAll();
        $this->assertEquals([], $returnValue);
    }

    /**
     * @test
     */
    public function returnWhateverDataTheAdapterProvides()
    {
        $this->adapter->expects($this->once())
            ->method('read')
            ->will($this->returnValue(['foo']));
        $returnValue = $this->db->findAll();
        $this->assertEquals(['foo'], $returnValue);
    }

    /**
     * @test
     */
    public function findAllCanFilterBasedOnInputCriterias()
    {
        $data = array(
            array(
                'foo' => 'bar',
            ),
            array(
                'foo' => 'baz'
            ),
        );
        $this->adapter->expects($this->once())
            ->method('read')
            ->will($this->returnValue($data));
        $returnValue = $this->db->findAll(array('foo' => 'bar'));
        $expected = array(
            array(
                'foo' => 'bar',
            ),
        );
        $this->assertEquals($expected, $returnValue);
    }
}
