<?php

use WekiWork\Http;

/**
 * @package Godoit Extended Assist CLI Helper Commands
 * @author  Moorexa Software Foundation
 */

class Console extends Assist
{
    // commands
    public static $commands = [
        'help' => 'Shows a help screen for Zema.',
        'prod' => 'Runs production commands for assist manager'
    ];

    // command help
    public static $commandHelp = [
        'help' => [
            'info' => 'Shows a help screen for Zema.'
        ],

        'prod' => [
            'info' => 'Runs production commands for assist manager',
            'commands' => [
                'php assist Zema:prod migrate' => 'Run migration for production site'
            ],
            'options' => [
                '-nozema' => 'ignore migration for zema tables',
                '-nodefault|-noglob|-noglobal' => 'ignore migration for default tables'
            ]
        ]
    ];

    // help command definition
    public static function help()
    {
        // display something simple
        self::out('You have reached the help screen for Godoit.');

        // you can also trigger the help method from the parent class
        // => parent::help($arg);

        // you should register this CLI Helper file in kernel/assist.php before use.
    }

    // more static methods.. 
    public static function _new($arg)
    {
        // change controller base path
        parent::$controllerBasePath = HOME . 'lab/Cms/MVC';

        // change table base path
        parent::$tablePath = 'Tables/';

        // ok call parent new method now
        parent::_new($arg);
    }

    // migrate command 
    public static function migrate($arg)
    {
        parent::$assistPath = HOME;
        
        // apply from
        array_push($arg, '-from='.HOME.'lab/Cms/Tables/', '-prefix=Zema_');

        // change query cache path 
        Moorexa\DB::prefixQuery('Zema_', function()
        {
            parent::$queryCachePath = HOME . 'lab/Cms/Database/QueryStatements.php';
        });

        // call migrate method
        parent::migrate($arg);
    }

    // production commands
    public static function prod($arg)
    {
        self::out(PHP_EOL);

        // set your live url
        $liveUrl = 'http://bdcng.co/workspace/centurion';
        
        // get object
        $ass = new Assist();

        // get action
        $action = $arg[0];

        switch ($action)
        {
            case 'migrate':
                self::sleep('Running migration to production server');

                if ($liveUrl != '')
                {
                    // get tables
                    $tables = array_splice($arg, 1);

                    // start connection
                    self::sleep($ass->ansii('green').'Connecting to'. $ass->ansii('reset').' '.$liveUrl);

                    // get assist token
                    $token = env('bootstrap', 'assist_token');

                    // no zema
                    $noZema = false;

                    // no default
                    $noDefault = false;

                    foreach ($tables as $index => $value)
                    {
                        switch(strtolower($value))
                        {
                            case '-nozema':
                                $noZema = true;
                                unset($tables[$index]);
                            break;

                            case '-nodefault':
                            case '-noglob':
                            case '-noglobal':
                                $noDefault = true;
                                unset($tables[$index]);
                            break;
                        }
                    }

                    $tables = implode(',', $tables);
                    if (strlen($tables) > 2)
                    {
                        $tables = ' '.$tables;
                    }

                    // build url
                    $urls = [
                        'zema' => urlencode("Zema:migrate".$tables),
                        'global' => urlencode("migrate".$tables)
                    ];

                    $http = Http::createInstance();
                    
                    // run query
                    foreach ($urls as $scope => $command)
                    {
                        $continue = false;

                        switch ($scope)
                        {
                            case 'zema':
                                if ($noZema === false)
                                {
                                    $continue = true;
                                }
                            break;

                            case 'global':
                                if ($noDefault === false)
                                {
                                    $continue = true;
                                }
                            break;
                        }

                        if ($continue)
                        {
                            self::sleep($ass->ansii('green').'Staging Execution for '. $ass->ansii('reset').' '.$liveUrl.'?command='.$command);
                            // execute query
                            $response = $http->header("assist-cli-token: {$token}")->query(['command' => $command])->get($liveUrl);
                            self::sleep($ass->ansii('green').'Running Migration for '.$scope.'..'. $ass->ansii('reset').' Receiving response from server...');
                            self::sleep('=== Response ===');
                            self::sleep($response->text);
                        }
                    }

                    self::out(PHP_EOL);
                    
                }
                else
                {
                    self::out(PHP_EOL.$ass->ansii('red').'Could not proceed. LiveURL not configured in '. __FILE__);
                }
            break;   
        }

        self::out(PHP_EOL);
    }
}