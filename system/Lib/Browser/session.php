<?php

namespace Moorexa;

/**
 * @package Moorexa Session Manager
 * @version 0.0.1
 * @author  Amadi Ifeanyi <amadiify.com>
 */

class Session extends Hash
{
    private $session_vars = [];
    private $session_key = false;

    public function __construct()
    {
        $this->session_vars = $_SESSION;
    }

    // get session data
    public function getSession($sessionKey = null)
    {
        $this->domain = is_null($this->domain) ? url() : $this->domain;
        $session = isset($_SESSION[$this->domain]) ? $_SESSION[$this->domain] : [];

        if (is_string($session))
        {
            $unserialized = unserialize($session);

            if (!is_null($sessionKey) && is_array($unserialized))
            {
                return $unserialized[$sessionKey];
            }
            
            return $unserialized;
        }

        return $session;
    }

    // get session
    final public function get($key)
    {   
        if (is_null($this->domain))
        {
            $this->domain = url();
        }

        if ($this->has($key))
        {
            $key = $this->getKey($key);

            $val = $this->getSession($key);
            $val = $this->_hashVal($val);

            $val = unserialize($val);

            if (is_array($val) && isset($val['___session__data']))
            {
                $val = $val['___session__data'];
            }
            else
            {
                if (is_array($val) && isset($val['__session__object']))
                {
                    $val = $val['__session__object'];
                }
            }

            return $val;
        }

        return false;
    }

    // set session
    final public function set($key, $val)
    {
        if (is_null($this->domain))
        {
            $this->domain = url();
        }

        if (is_array($val))
        {
            $val = serialize($val);
        }
        elseif (is_callable($val))
        {
            $ref = new \ReflectionFunction($val);
            if ($ref->isClosure())
            {
                $wrapper = new \Opis\Closure\SerializableClosure($val);
                $val = serialize($wrapper);
            }
            else
            {
                $val = serialize(['___session__data' => $val]);
            }
            $ref = null;
        }
        elseif (is_object($val) && !is_callable($val))
        {
            $val = ['__session__object' => $val];
            $val = serialize($val);
        }
        else
        {
            $val = serialize(['___session__data' => $val]);
        }

        $hashed = $this->_hash($val);
        $domainSession = $this->getSession();

        $domainSession[$this->getKey($key)] = $hashed;


        $_SESSION[$this->domain] = serialize($domainSession);
        
        return true;
    }

    // get all session
    final public function all()
    {
        if (is_null($this->domain))
        {
            $this->domain = url();
        }


        $sess = $this->getSession();
        $all = [];


        foreach ($sess as $key => $val)
        {
            $keyv = substr($key, strpos($key, '_')+1);

            $hash = $this->getKey($keyv);

            $val = $this->_hashVal($val);

            if (is_serialized($val))
            {
                $val = unserialize($val);	
            }

            $all[$keyv] = $val;
        }

        return $all;
    }

    // session keys
    final public function keys()
    {
        return array_keys($this->all());
    }

    public function getKey($name)
    {
        if (is_null($this->domain))
        {
            $this->domain = url();
        }

        // secret key
        $key = Bootloader::boot('secret_key');

        if (is_string($name))
        {
            return substr(hash('sha256', '/session/' . $name . '/key/' . $key), 0, 10) . '_' . $name;
        }

        return false;
    }

    // session has key?
    final public function has($key, &$val=null)
    {
        $session = $this->getSession();
        $key = $this->getKey($key);

        if (isset($session[$key]))
        {
            $val = $session[$key];
            $val = $this->_hashVal($val);

            $val = unserialize($val);

            if (is_array($val) && isset($val['___session__data']))
            {
                $val = $val['___session__data'];
            }
            else
            {
                if (is_array($val) && isset($val['__session__object']))
                {
                    $val = $val['__session__object'];
                }
            }
            
            return true;
        }

        return false;
    }

    // return val then delete
    final public function pop($key)
    {
        if (is_null($this->domain))
        {
            $this->domain = url();
        }

        $val = $this->get($key);
        $this->drop($key);
        return $val;
    }

    // drop a session
    final public function drop()
    {
        if (is_null($this->domain))
        {
            $this->domain = url();
        }

        $keys = func_get_args();
        $session = $this->getSession();

        foreach ($keys as $key => $v)
        {
            $key = $this->getKey($v);

            if (isset($session[$key]))
            {
                unset($session[$key]);
            }
        }

        if (is_array($session))
        {
            $_SESSION[$this->domain] = serialize($session);
        }

        return true;
    }

    // empty session
    final public function _empty()
    {
        $all = $this->all();

        if (count($all) > 0)
        {   
            $_SESSION[$this->domain] = serialize([]);

            return true;
        }

        return false;
    }

    // destroy session
    final public function destroy()
    {
        $this->_empty();
    }

    // check if val matches 
    final public function is($val)
    {
        if (is_null($this->domain))
        {
            $this->domain = url();
        }

        if ($this->session_key !== false)
        {
            $v = $this->get($this->session_key);

            if ($val == $v)
            {
                return true;
            }

            return false;
        }
    }

    // MAGIC METHODS
    public function __call($key, $args)
    {
        if ($key == 'empty')
        {
            return $this->_empty();
        }
        else
        {
            if (!isset($args[0]))
            {
                return $this->get($key);
            }
            else
            {
                if (isset($args[0]))
                {
                    $this->set($key, $args[0]);

                    return true;
                }
            }
        }

        return false;
    }

    public function __get($key)
    {
        return $this->get($key);
    }
}