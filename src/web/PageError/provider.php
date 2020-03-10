<?php

/**
 * PageError Provider. Gets autoloaded with class
 * @package PageError provider
 */

class PageErrorProvider extends PageError
{
    // load class aliases 
    public $classAliases = [
        'query' => Centurion\Helpers\Query::class
    ];
    
    /**
     * @method Boot startup 
     * This method would be called upon startup
     */
    public function boot($next)
    {
       // turn on display for nav
       $this->display = 'light bootsnav on';

       // call route! Applies Globally.
       $next();
    }

    /**
     * @method onHomeInit  
     * This method would be called upon route request to PageError/home
     */
    public function onHomeInit($next)
    {
        // route passed!
        $next();
    }

    // you can register more init methods for your view models.
}