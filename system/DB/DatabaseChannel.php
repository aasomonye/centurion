<?php
namespace system\DB;
use Moorexa\DB;

class DatabaseChannel
{
    private $callback; // callback function passed;
    public  $table; // table calling
    public  $method; // method calling
    public  $canContinue = null;
    private $query;
    
    // load constructor
    public function __construct(&$callback=null)
    {
        $this->callback = $callback;
    }

    // build object
    public function buildObject(string $method, DB &$query)
    {
        $this->canContinue = null;
        $this->method = $method;
        $this->table = $query->table;
        $this->query = &$query;

        // call callback method
        return call_user_func($this->callback, $this);
    }

    // check for method
    public function has(string $method, $fallthrough = null)
    {
        $methods = explode('|', $method);

        foreach ($methods as $method)
        {
            if ($method == $this->method)
            {
                if (is_array($fallthrough))
                {
                    list($class, $method) = $fallthrough;

                    $class = BootMgr::singleton($class);

                    if (method_exists($class, $method))
                    {
                        call_user_func_array([$class, $method], [$this->table, &$this->query, &$this]);
                    }
                }
                elseif (is_callable($fallthrough) && !is_null($fallthrough))
                {
                    call_user_func_array($fallthrough, [$this->table, &$this->query, &$this]);
                }
                else
                {
                    return true;
                }
            }
        }

        return false;
    }
    
    // check for a table
    public function table(string $table, $fallthrough = null)
    {
        $tables = explode('|', $table);

        foreach ($tables as $table)
        {
            if ($table == $this->table)
            {
                if (is_array($fallthrough))
                {
                    list($class, $method) = $fallthrough;

                    $class = BootMgr::singleton($class);

                    if (method_exists($class, $method))
                    {
                        call_user_func_array([$class, $method], [$this->table, &$this->query, &$this, $this->method]);
                    }
                }
                elseif (is_callable($fallthrough) && !is_null($fallthrough))
                {
                    call_user_func_array($fallthrough, [$this->table, &$this->query, &$this, $this->method]);
                }
                else
                {
                    return true;
                }
            }
        }

        return false;
    }

    // check if bind has data
    public function bindHas(string $key)
    {
        if (isset($this->query->bind[$key]))
        {
            return true;
        }

        return false;
    }

    // set bind
    public function setBind(string $key, $value)
    {
        $this->query->setBind($key, $value);
    }

    // lock execution
    public function lock()
    {
        $this->canContinue = false;
    }
}