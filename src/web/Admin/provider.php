<?php

use Centurion\Helpers\UI;

/**
 * Admin Provider. Will be loaded before the Admin controller
 * @package App provider
 */

class AdminProvider extends Admin
{
    // load class aliases 
    public $classAliases = [
        'query' => Centurion\Helpers\Query::class
    ];

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

    // listen for notification
    public function hasNotification(string $page_link)
    {
        $notification = 0;

        switch ($page_link)
        {
            case 'admin/listing':
                // check unverified list
                $notification = $this->query->unverifiedListingsForAdmin()->rows;
            break;

            case 'admin/listing/property':
                // check unverified list for property
                $notification = $this->query->unverifiedListingsForAdmin('property')->rows;
            break;

            case 'admin/listing/cars':
                // check unverified list for cars
                $notification = $this->query->unverifiedListingsForAdmin('cars')->rows;
            break;

            case 'admin/partners':
                // check unverified partners
                $notification = $this->query->unverifiedPartners()->rows;
            break;
        }

        return UI::navigationNotification($notification);
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