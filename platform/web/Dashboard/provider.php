<?php

use Centurion\Helpers\Alert;
/**
 * Dashboard Provider. Will be loaded before the Dashboard controller
 * @package App provider
 */

class DashboardProvider extends Dashboard
{
    public $defaultPages = [
        'Profile Update' => 'dashboard/complete-registration',
        'Profile' => 'dashboard/profile',
        'Support' => ''
    ];

    /**
     * @method DashboardProvider boot
     * This method would be called before controller renders a view
     * @param $next
     */
    public function boot($next)
    {
        config('loadStatic', read_json(HOME . 'Centurion/Public/adminStaticPack.json'));
        
        // call view! Applies Globally.
        $next();

        if ($this->has('dashboardMessage'))
        {
            Alert::toastDefaultSuccess($this->dashboardMessage);
        }
    }

    /**
     * @method DashboardProvider onHomeInit
     * This method would be called upon route request to Dashboard/home
     * @param $next
     */
    public function onHomeInit($next)
    {
        // route passed!
        $next();
    }

    // you can register more init methods for your view models.
    public function onCompleteRegistrationInit($next)
    {
        $this->requirejs('Centurion/Public/form.js');

        $next();
    }
}