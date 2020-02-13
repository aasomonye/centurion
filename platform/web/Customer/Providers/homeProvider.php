<?php

/**
 * @package Home View Page Provider
 * @author Moorexa <moorexa.com>
 */

class CustomerHomeProvider extends CustomerProvider
{
    /**
     * @method CustomerHomeProvider viewDidEnter
     *
     * #called upon rendering view
     */
    public function viewDidEnter()
    {

    }

    /**
     * @method CustomerHomeProvider viewWillEnter
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