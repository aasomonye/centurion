<?php
namespace Centurion\Helpers;

class Alert
{
    public static function __callStatic($message, $args)
    {
        // get controller
        $controller = boot()->get('\Moorexa\Controller');

        dropbox('alertFunc', $message);
        dropbox('alertFuncArgs', $args);

        $controller->requirejs('php-vars.js');
        $controller->requirejs('Centurion/Public/alerts.js');
    }
}