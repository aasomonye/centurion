<?php
namespace system\Lib;

class AppRegistry
{
    // defined keys
    public $definedKey;

    // register to
    private $registerTo = [];

    // registry
    private $registry;

    // load constructor
    public function __construct(&$registry)
    {
        $this->registry = $registry;
    }

    // key method
    public function key($name)
    {
        $this->definedKey = $name;

        if (isset($this->registry[$name]))
        {
            $this->registerTo[$name] = &$this->registry[$name];
        }

        return $this;
    }

    // registry method
    public function register($value)
    {
        $key = $this->definedKey;

        if (isset($this->registerTo[$key]))
        {
            switch (gettype($this->registerTo[$key]))
            {
                case 'array':
                    $declared = &$this->registerTo[$key];
                    $declared[] = $value;
                    break;

                case 'object':
                    $this->registerTo[$key]->{$key} = $value;
                    break;

                default:
                    $this->registerTo[$key] = $value;
            }
        }
        else
        {
            $this->registerTo[$key] = &$value;
        }

        return $this;
    }

    // setter method
    public function set($key, $val)
    {
        $this->registerTo[$key] = &$val;
    }

    // has method
    public function has($key, &$val)
    {
        if (isset($this->registerTo[$key]))
        {
            $val = $this->registerTo[$key];

            return true;
        }
    }

    // getter method
    public function get($key)
    {
        if ($this->has($key, $val))
        {
            return $val;
        }

        return null;
    }
}