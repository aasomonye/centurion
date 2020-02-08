<?php

/**
 * Admin Provider. Will be loaded before the Admin controller
 * @package App provider
 */

class AdminProvider extends Admin
{
    /**
     * @method AdminProvider boot
     * This method would be called before controller renders a view
     * @param $next
     */
    public function boot($next)
    {
        config('loadStatic', read_json(HOME . 'Centurion/Public/adminStaticPack.json'));

        // call view! Applies Globally.
        $next();
    }

    /**
     * @method AdminProvider onHomeInit
     * This method would be called upon route request to Admin/home
     * @param $next
     */
    public function onHomeInit($next)
    {
        // route passed!
        $next();
    }

    // you can register more init methods for your view models.
}