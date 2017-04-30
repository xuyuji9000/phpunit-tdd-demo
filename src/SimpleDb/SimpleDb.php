<?php
namespace TestDemo\SimpleDb;

use TestDemo\SimpleDb\Adapter\AdapterInterface;

class SimpleDb
{
    private $adapter;

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }


    public function findAll(array $criterias = array())
    {
        $filteredData = array();
        $rawData = $this->adapter->read();

        if(!$criterias)
        {
            return $rawData;
        }

        foreach($rawData as $record)
        {
            foreach($criterias as $field => $value)
            {
                if($value == $record[$field])
                {
                    $filteredData[] = $record;
                }
            }
        }

        return $filteredData;
    }
}
