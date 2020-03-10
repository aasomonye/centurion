<?php

// use Moorexa\Model;
// use Moorexa\Packages as Package;
use Centurion\Helpers\Alert;
use Centurion\Helpers\UI;
use Moorexa\HttpGet as Get;

/**
 * Documentation for Admin Page can be found in Admin/readme.txt
 *
 *@package	Admin Page
 *@author  	Moorexa <www.moorexa.com>
 **/

class Admin extends Moorexa\Controller
{
	/**
    * @method Admin home
    *
    * See documentation https://www.moorexa.com/doc/controller
    *
    * You can catch params sent through the $_GET request
    * @return void
    **/

	public function home()
	{
		$this->render('home');
	}
	/**
    * @method Admin users
    *
    * See documentation https://www.moorexa.com/doc/controller
    *
    * You can catch params sent through the $_GET request
    * @return void
    **/

	public function users()
	{
        // manage revoked user
        $this->modelAction('RevokeUserAccess', function($revoked)
        {
            if ($revoked)
            {
                Alert::toastDefaultSuccess('User admin access has been revoked successfully.');
            }
        });

        // manage update to admin user
        $this->modelAction('MakeUserAdmin', function($migrated)
        {
            if ($migrated)
            {
                Alert::toastDefaultSuccess('User has been guranted admin access.');
            }
        });

		$this->render('users');
	}
	/**
    * @method Admin dashboard
    *
    * See documentation https://www.moorexa.com/doc/controller
    *
    * You can catch params sent through the $_GET request
    * @return void
    **/

	public function dashboard()
	{
		$this->render('dashboard');
	}
	/**
    * @method Admin partners
    *
    * See documentation https://www.moorexa.com/doc/controller
    *
    * You can catch params sent through the $_GET request
    * @return void
    **/

	public function partners()
	{
        $this->requirejs('php-vars.js');

        $this->modelAction('ApprovePartnership', function($processed)
        {
            if ($processed)
            {
                Alert::toastDefaultSuccess('You successfully approved user partnership request.');
            }
        });

        $this->modelAction('DeclinePartnership', function($processed)
        {
            if ($processed)
            {
                Alert::toastDefaultSuccess('You successfully declined user partnership request.');
            }
        });

		$this->render('partners');
	}
	/**
    * @method Admin listing
    *
    * See documentation https://www.moorexa.com/doc/controller
    *
    * You can catch params sent through the $_GET request
    * @return void
    **/

	public function listing($listingType, Get $get)
	{
        // allowed actions
        $allowedActions = ['list' => 'Add a property', 'view' => 'View property'];

        $view = UI::generateViewPath('admin/listing', $listingType, function($view){
            UI::pageTitle(ucwords($view) . ' Listing');
        });

        if ($get->has('approve', $listingid))
        {
            // approve listing
            if ($this->approveListing($listingid))
            {
                Alert::toastDefaultSuccess('You successfully approved, partner listing.');
            }
        }

        if ($get->has('suspend', $listingid))
        {
            // suspend listing
            if ($this->suspendListing($listingid))
            {
                Alert::toastDefaultSuccess('You suspended partner listing successfully.');
            }
        }

        if ($get->has('bookable', $listingid))
        {
            // reactivate listing
            if ($this->bookableListing($listingid))
            {
                Alert::toastDefaultSuccess('You opened up partner listing successfully.');
            }
        }

		$this->render($view);
	}
}
// END class