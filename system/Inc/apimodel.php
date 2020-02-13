<?php

namespace Moorexa;

use Moorexa\DB;

/**
 * @package ApiModel
 * @author Amadi Ifeanyi <amadiify.com>
 */

class ApiModel extends InputData
{
    // tables
    private static $tables = [];

    // current table
    public $table = null;

    // transactions
    public $transactions = [];

    // promise returned after query using exists method
    private $queryReturned;

    // caller method
    public function __call($meth, $args)
    {
        if (preg_match('/([a-z]{2,})([A-Z]{1})([\S]+)/', $meth, $req))
        {
            $action = $req[1];

            $table = lcfirst($req[2].$req[3]);

            $this->getTable($c_table);

            $this->currentObject->table = $table;

            // call method
            $this->transactions[$meth]['return'] = call_user_func_array([$this, $action], $args);

            // return to current
            $this->currentObject->table = $c_table;
        }
        elseif ($meth == 'has')
        {
            return $this->_has($args[0]);
        }
        else
        {
            $req = $this->switchOptions($meth, $args);

            if ($req !== null)
            {
                return $req;
            }
        }

        return $this;
    }

    // switch options
    public function switchOptions($meth, $args, $defaultToDB = true)
    {
        if ($meth == 'update' && count($args) == 0)
        {
            return $this->__update();
        }
        elseif ($meth == 'fetch' || $meth == 'get' && count($args) == 0)
        {
            return $this->__fetch();
        }
        elseif ($meth == 'remove' && count($args) == 0)
        {
            return $this->__remove();
        }
        elseif (isset($this->__rules__[$meth]))
        {
            if (!isset($args[0]))
            {
                return $this->getRule($meth);
            }
            else
            {
                $this->__rules__[$meth]['value'] = $args[0];

                // revalidate and remove from required
                $this->revalidate($meth, $args[0]);
            }

            return $this;
        }
        else
        {
            if ($defaultToDB)
            {
                $this->getTable($table);

                // assign table
                $db = DB::table($table);

                // call method
                return call_user_func_array([$db, $meth], $args);
            }
        }

        return null;
    }

    // create record
    public function create(&$id=0)
    {
        if ($this->isOk())
        {
            if (is_null($this->table))
            {
                $this->getTable($table);
                $this->table = $table;
            }

            $this->table = DB::getTableName($this->table);

            // create record
            $insert = DB::table($this->table)->insert($this);

            if ($insert->ok)
            {
                // good
                $id = $insert->id;
                $this->transactions['create'.ucfirst($this->table)]['args'] = [$id];
                $this->queryReturned = $insert;

                return true;
            }
        }

        return false;
    }

    // update record
    public function __update()
    {
        if ($this->isOk())
        {
            static $promise;

            if (is_null($this->table))
            {
                $this->getTable($table);
                $this->table = $table;
            }

            $this->table = DB::getTableName($this->table);

            if (is_null($promise))
            {
                // get promise
                $promise = new DBPromise();
            }

            $promise->table = $this->table;

            if (count($this->identityCreated) == 0)
            {
                // get primary key
                $promise->getTableInfo($pri);

                // get id
                $id = $this->getRule($pri);
            }
            else
            {
                $keys = array_keys($this->identityCreated);

                // get primary key
                $pri = $keys[0];

                // get id
                $id = $this->identityCreated[$pri];

                // reset
                $this->identityCreated = [];
            }

            if (!is_null($id))
            {
                // run update
                $update = DB::table($this->table)->update($this->currentObject, $pri . ' = ?', $id);
                $this->queryReturned = $update;

                if ($update->ok)
                {
                    return true;
                }

                return false;
            }
            
            $error = 'Primary KEY #{'.$pri.'} not found in rules';

            throw new \Exception($error);

            return false;
        }

        return false;
    }

    // delete record
    public function __remove()
    {
        if ($this->isOk())
        {
            static $promise;

            if (is_null($this->table))
            {
                $this->getTable($table);
                $this->table = $table;
            }

            $this->table = DB::getTableName($this->table);

            if (is_null($promise))
            {
                // get promise
                $promise = new DBPromise();
            }

            $promise->table = $this->table;


            if (count($this->identityCreated) == 0)
            {
                // get primary key
                $promise->getTableInfo($pri);

                // get id
                $id = $this->getRule($pri);
            }
            else
            {
                $keys = array_keys($this->identityCreated);

                // get primary key
                $pri = $keys[0];

                // get id
                $id = $this->identityCreated[$pri];

                // reset
                $this->identityCreated = [];
            }

            if (!is_null($id))
            {
                // run delete
                $delete = DB::table($this->table)->delete($pri . ' = ?', $id);
                $this->queryReturned = $delete;

                if ($delete->ok)
                {
                    return true;
                }

                return false;
            }
            
            $error = 'Primary KEY #{'.$pri.'} not found in rules';

            throw new \Exception($error);

            return false;
        }

        return false;
    }

    // fetch record
    public function __fetch()
    {
        if ($this->isOk())
        {
            static $promise;

            if (is_null($this->table))
            {
                $this->getTable($table);
                $this->table = $table;
            }

            $this->table = DB::getTableName($this->table);

            if (is_null($promise))
            {
                // get promise
                $promise = new DBPromise();
            }

            $promise->table = $this->table;

            if (count($this->identityCreated) == 0)
            {
                // get primary key
                $promise->getTableInfo($pri);

                // get id
                $id = $this->getRule($pri);
            }
            else
            {
                $keys = array_keys($this->identityCreated);

                // get primary key
                $pri = $keys[0];

                // get id
                $id = $this->identityCreated[$pri];

                // reset
                $this->identityCreated = [];
            }

            if (!is_null($id))
            {
                $object = $this->currentObject;
                $object->{$pri} = $id;

                // run get
                $get = DB::table($this->table)->get($object);

                return $get;
            }
            elseif ($pri != null)
            {
                $get = DB::table($this->table)->get($this->currentObject);

                return $get;
            }
            
            $error = 'Primary KEY #{'.$pri.'} not found in rules';

            throw new \Exception($error);

            return false;
        }

        return false;
    }

    // listen for then
    public function then($callback)
    {
        $begin = array_shift($this->transactions);

        if ($begin['return'])
        {
            // get arguments
            $const = [];
            Route::getParameters($callback, $const, $begin['args']);

            call_user_func_array($callback, $const);
        }
    }

    public function asDefault()
    {
        if (!is_null(self::$modelInstance))
        {
            self::$modelInstance->__rules__ = $this->__rules__;
        }

        return $this;
    }

    // get table
    private function getTable(&$table=null)
    {
        // get class name
        $className = get_class($this->currentObject);

        // create reflection class
        $reflectionClass = new \ReflectionClass($className);
        
        // get properties
        $properties = $reflectionClass->getProperties();
        
        // class properties
        $classProperties = [];

        // get properties for class only
        array_map(function($object) use (&$classProperties, $className){
            if ($object->class == $className)
            {
                $classProperties[$object->name] = $this->currentObject->{$object->name};
            }
        }, $properties);


        // check property
        if (isset($classProperties['table']))
        {
            $table = $this->currentObject->table;
        }

        if (!is_null($this->table) && is_null($table))
        {
            $table = $this->table;
        }

        if ($table == null)
        {
            // get table
            $className = get_class($this->currentObject);

            // get class name
            $className = substr($className, strpos($className, '\\')+1);

            $table = $className;
        }

        return $table;
    }

    // match if not all
    public function ifNotAll()
    {
        // get table;
        $this->getTable($table);

        // get arguments
        $args = func_get_args();

        // build query
        $where = [];

        array_map(function($val) use (&$where)
        {
            $where[$val] = $this->getRule($val);

        }, $args);

        // run get request
        $check = DB::table($table)->get($where);
        $this->queryReturned = $check;

        if ($check->rows == 0)
        {
            return true;
        }

        // clean up
        $args = null;

        // failed
        return false;
    }

    // match if not all
    public function ifNotSome()
    {
        // get table;
        $this->getTable($table);

        // get arguments
        $args = func_get_args();

        // build query
        $where = [];

        array_map(function($val) use (&$where)
        {
            $where[$val] = $this->getRule($val);

        }, $args);

        // run get request
        $check = DB::table($table)->get($where, 'OR');
        $this->queryReturned = $check;
        
        if ($check->rows == 0)
        {
            return false;
        }

        // clean up
        $args = null;

        // success
        return true;
    }

    // exists
    public function exists(&$check=null)
    {
        // get table;
        $this->getTable($table);

        $table = DB::getTableName($table);

        if ($this->isOk())
        {
            // run check
            $check = DB::table($table)->get($this);
            
            if ($check->rows > 0)
            {
                if (count($this->identityCreated) > 0)
                {
                    $this->pushObject($check);
                }

                // set query returned
                $this->queryReturned = $check;
                
                // passed
                return true;
            }
        }

        // failed.
        return false;
    }

    // factory settings
    public function toFactory($var, $val)
    {
        $this->{$var} = $val;

        return $this;
    }

    // promise method returned
    public function getQuery()
    {
        return $this->queryReturned;
    }
    
}