<?php

namespace Centurion\Helpers;
use Moorexa\Event;

class Alert
{
    public static function __callStatic($message, $args)
    {
        dropbox('alertFunc', $message);
        dropbox('alertFuncArgs', $args);

        Event::on('guards.load', function(){
            // get controller
            $controller = boot()->get('\Moorexa\Controller');

            $controller->requirejs('php-vars.js');
            $controller->requirejs('Centurion/Public/alerts.js');
        });
    }
}