<?php

namespace TestDemo\SimpleDb\Adapter;

class JsonFile implements AdapterInterface
{

    protected $file;

    public function __construct($file)
    {
        if(!file_exists($file))
            throw new \InvalidArgumentException('File does not exist.');
        $this->file = $file;
    }

    public function read()
    {
        
        $contents = file_get_contents($this->file);

        return json_decode($contents, true);

    }

    public function write(array $data)
    {
    }

}
