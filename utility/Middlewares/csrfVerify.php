<?php 

use Moorexa\Middleware;

class CsrfVerify
{
    private $channels = [];
    public static $error = null;
    public static $headers = [];
    private static $allHeaders = [];

    public function channel(array $channel)
    {
        $this->channels = $channel;
        return $this;
        
    }

    // get headers
    public function getHeaders()
    {
        return self::$allHeaders;
    }

    public function headers()
    {
        $header = func_get_args();
        
        $verify = true;
        $types = [];
        $headerFound = false;
        $passed = false;

        Moorexa\Route::api(function() use (&$verify, &$types, &$headerFound, &$passed, &$header){

            if (count($header) > 0)
            {
                foreach ($this->channels as $channel => $type)
                {
                    if ($type === CSRF_VERIFY_HEADER)
                    {
                        $types[] = $type;
                        $verify = false;

                        if (is_callable('getallheaders'))
                        {
                            $headers = \WekiWork\Http::getHeaders();
                            
                            foreach ($header as $i => $h)
                            {
                                $key = trim(substr($h, 0, strpos($h,':')));
                                $v = trim(substr($h, strpos($h,':')+1));

                                if (isset($headers[$key]))
                                {
                                    $headerFound = true;
                                    $val = $headers[$key];

                                    if ($val == $v)
                                    {
                                        $verify = true;
                                        self::$headers[$key] = $val;
                                    }
                                }
                            }
                            break;
                        }
                    }
                }

                // get all headers
                foreach ($header as $i => $h)
                {
                    $key = trim(substr($h, 0, strpos($h,':')));
                    $v = trim(substr($h, strpos($h,':')+1));

                    self::$allHeaders[$key] = $v;
                }
                    
            }

            if (count($types) > 0)
            {
                foreach ($types as $I => $type)
                {
                    if ($type !== CSRF_VERIFY_HEADER && $verify === true)
                    {
                        $passed = true;
                        break;
                    }
                }
            }
        });

        if (!$passed)
        {
            self::$error = "CSRF Public Request Token not valid.";

            if (!$headerFound)
            {
                self::$error = "CSRF Public request header missing for this request.";
            }
        }
        else
        {
            $verify = true;
        }

        return false;
    }
}