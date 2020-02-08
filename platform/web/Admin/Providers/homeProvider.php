<?php

/**
 * @package Home View Page Provider
 * @author Moorexa <moorexa.com>
 */

class AdminHomeProvider extends AdminProvider
{
    /**
     * @method AdminHomeProvider viewDidEnter
     *
     * #called upon rendering view
     */
    public function viewDidEnter()
    {

    }

    /**
     * @method AdminHomeProvider viewWillEnter
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