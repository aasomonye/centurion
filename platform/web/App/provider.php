<?php

/**
 * App Provider. Gets autoloaded with class
 * @package App provider
 */

class AppProvider extends App
{
    private $viewsExceptions = ['login', 'register', 'resetPassword', 'changePassword'];

    /**
     * @method Boot startup 
     * This method would be called upon startup
     */
    public function boot($next, $view)
    {
       // preload alert
       Moorexa\Rexa::preload('alert');
       
       if (in_array($view, $this->viewsExceptions))
       {
           config('loadStatic', read_json(HOME . 'Centurion/Public/adminStaticPack.json'));

           // hide header and footer. And set the page title 
           $this->customConfig([
               'blankPage' => true,
               'apptitle' => ucfirst($view)
           ]);
       }

       // call route! Applies Globally.
       $next();
       
    }

    /**
     * @method onHomeInit  
     * This method would be called upon route request to App/home
     */
    public function onHomeInit($next)
    {
        // route passed!
        $next();
    }

    // you can register more init methods for your view models.
}