<?php
namespace system\DB;

use Moorexa\DB\ORMReciever;
use Moorexa\DatabaseHandler;
use Moorexa\DB;

class AutoloadTableName extends ORMReciever
{
    private static $thisclass;
    public $name = null;

    public function __construct($className)
    {
        if (isset(DatabaseHandler::$databaseTables[$className]))
        {
            $className = DatabaseHandler::$databaseTables[$className];
        }

        $db = new DB();
        $db->table = $className;

        parent::getInstance($db);

        $db = null;
        return $this;
    }
}