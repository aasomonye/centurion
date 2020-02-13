<?php

/**
 * @package TemplateGuard
 * @author  Moorexa Assist
 */

class TemplateGuard extends Guards
{
    // allow specific requests
    public $allow = ['App', 'Dashboard', 'PageError']; 

    // allow all except this requests
    public $allowAllExcept = [];

    // #code here.
    public function switchTemplate()
    {
        config('loadStatic', read_json(HOME . 'Centurion/Public/adminStaticPack.json'));

        $controller = boot()->get('Moorexa\Controller');

        // change header and footer
        $template = 'Centurion/Public/Templates/';

        $controller->loadHeader($template . 'header.html');
        $controller->loadFooter($template . 'footer.html');
    }
}