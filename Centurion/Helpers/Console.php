<?php

use Moorexa\DB;

class Console extends Assist
{
    // truncate helper method for some tables
    private static $tables = [
        'activations',
        'authentication',
        'login_tracker',
        'mail_logger',
        'users',
        'users_information'
    ];

    // help screen, providing more information
    public static $commands = [
        'truncate' => 'Truncate database table'
    ];

    // trunctate method
    public static function truncate()
    {
        self::out(PHP_EOL);

        $ass = new Assist;

        // start database 
        $database = DB::serve();

        // Get table name
        foreach (self::$tables as $table)
        {
            $tableName = DB::getTableName($table);

            // run query
            $run = $database->sql('TRUNCATE TABLE '. $tableName);

            $success = $run->ok ? $ass->ansii('green') . ' successful.' : $ass->ansii('red') . ' failed.';

            // run sql statement
            self::sleep('Truncating table "'.$tableName.'"' . $success . $ass->ansii('reset'));
        }

        self::out(PHP_EOL);
    }
}