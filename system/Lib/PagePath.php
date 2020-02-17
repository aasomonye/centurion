<?php
namespace system\Lib;

class PagePath
{
    private $basepath;
    private $filepath;

    // load construtor
    public function __construct($basePath, $filepath)
    {
        $this->basepath = $basePath;
        $this->filepath = $filepath;
    }

    // to string magic method
    public function __toString()
    {
        return $this->find($this->filepath);
    }

    // find file
    public function find($filename)
    {
        if (!is_null($filename))
        {
            $path = deepScan($this->basepath, $filename);

            if ($path != '')
            {
                return url($path);
            }
        }

        return '';
    }
}