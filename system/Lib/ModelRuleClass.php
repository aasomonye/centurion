<?php

namespace system\Lib;

class ModelRuleClass extends \Moorexa\ApiModel
{
    // table name
    public $table;

    // callback function
    private $__callback_func;

    // createmodelrule
    public $usingRule = true;

    // constructor
    public function __construct($tableName, $object, &$body)
    {
        $this->table = $tableName;

        if (is_callable($object))
        {
            $this->__callback_func = $object;

            // call set rule
            \Moorexa\ApiModel::getSetRules($this);

            $body = $this;
        }
    }

    // create rule
    public function setRules($body)
    {
        if (is_callable($this->__callback_func))
        {
            $argument = [];
            $argument[] = &$body;

            \Moorexa\Route::getParameters($this->__callback_func, $const, $argument);

            // call callback function
            call_user_func_array($this->__callback_func, $const);
        }
    }
}