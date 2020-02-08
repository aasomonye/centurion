<?php

/**
 * @package Home View Page Provider
 * @author Moorexa <moorexa.com>
 */

class DashboardHomeProvider extends DashboardProvider
{
    /**
     * @method DashboardHomeProvider viewDidEnter
     *
     * #called upon rendering view
     */
    public function viewDidEnter()
    {

    }

    /**
     * @method DashboardHomeProvider viewWillEnter
     *
     * #called before rendering view
     * @param $next
     */
    public function viewWillEnter($next)
    {
        // route passed
        $next();
    }
}