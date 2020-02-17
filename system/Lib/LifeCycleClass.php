<?php
namespace system\Lib;

class LifeCycleClass
{
    // save all attachments
    private static $attachments = [];

    // request
    public $request;

    // watchman
    public static $watchman = [];

    // constructor
    public function __construct($request)
    {
        $this->request = $request;
    }

    // attach an handle
    public function attach($handle, $data)
    {
        self::$attachments[$this->request][$handle] = $data;
    }

    // load breakpoint
    public function breakpoint($handle)
    {
        if (isset(self::$attachments[$this->request]))
        {
            $request = self::$attachments[$this->request];

            // check for handle
            if (isset($request[$handle]))
            {
                $data = $request[$handle];

                if (is_callable($data))
                {
                    // get args
                    \Moorexa\Route::getParameters($data, $const);

                    $func = call_user_func_array($data, $const);

                    if (isset(self::$watchman[$this->request]))
                    {
                        if (isset(self::$watchman[$this->request][$handle]))
                        {
                            $watchman = self::$watchman[$this->request][$handle];

                            if (is_callable($watchman))
                            {
                                // get args
                                \Moorexa\Route::getParameters($watchman, $const);
                                // call
                                call_user_func_array($watchman, $const);
                            }
                        }
                    }

                    return $func;
                }

                return $data;
            }
        }
    }

    // watch breakpoint
    public function watch($handle, $data)
    {
        self::$watchman[$this->request][$handle] = $data;
    }
}