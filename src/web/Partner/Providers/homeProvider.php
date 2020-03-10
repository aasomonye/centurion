<?php

/**
 * @package Home View Page Provider
 * @author Moorexa <moorexa.com>
 */

class PartnerHomeProvider extends PartnerProvider
{
    /**
     * @method PartnerHomeProvider viewDidEnter
     *
     * #called upon rendering view
     */
    public function viewDidEnter()
    {

    }

    /**
     * @method PartnerHomeProvider viewWillEnter
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