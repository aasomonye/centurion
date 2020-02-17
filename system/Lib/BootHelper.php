<?php
namespace system\Lib;

class BootHelper
{
    public function singleton()
    {
        return call_user_func_array('\utility\Classes\BootMgr\Manager::singleton', func_get_args());
    }

    public function method()
    {
        return call_user_func_array('\utility\Classes\BootMgr\Manager::method', func_get_args());
    }

    public function assign()
    {
        return call_user_func_array('\utility\Classes\BootMgr\Manager::assign', func_get_args());
    }

    public function get(string $className, $callback = null)
    {
        switch (!is_null($callback) && is_callable($callback))
        {
            case true:
                $instance = $this->singleton($className);

                call_user_func($callback, $instance);

                return $instance;

            case false:

                if (strpos($className, '@') === false)
                {
                    return $this->singleton($className);
                }

                return $this->method($className);
        }
    }

    // check named
    public function hasNamed(string $className)
    {
        $named = \utility\Classes\BootMgr\Manager::$named;

        if (isset($named[$className]))
        {
            return true;
        }

        return false;
    }

    // get named
    public function getNamed(string $className)
    {
        return \utility\Classes\BootMgr\Manager::$named[$className];
    }
}