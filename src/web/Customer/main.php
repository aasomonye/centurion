<?php

// use Moorexa\Model;
// use Moorexa\Packages as Package;
use Centurion\Helpers\UI;
use Centurion\Helpers\Alert;
use Centurion\Models\Input;
use Moorexa\HttpPost;
use Centurion\Models\Users;

/**
 * Documentation for Customer Page can be found in Customer/readme.txt
 *
 *@package	Customer Page
 *@author  	Moorexa <www.moorexa.com>
 **/

class Customer extends Moorexa\Controller
{
	/**
    * @method Customer home
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
    * @method Customer dashboard
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
    * @method Customer becomeAPartner
    *
    * See documentation https://www.moorexa.com/doc/controller
    *
    * You can catch params sent through the $_GET request
    * @return void
    **/

	public function becomeAPartner(HttpPost $post, Users $users)
	{
        UI::pageTitle('Become a partner');

        // manage submission
        $this->modelAction('postBecomeAPartner', function($processed)
        {
            if ($processed)
            {
                Alert::toastDefaultSuccess('Your request has been submitted successfully. You will be contacted upon approval.');
            }
        });

        // was request declined
        $businessInfo = $this->query->getBusinessInformation();

        if ($businessInfo->rows > 0)
        {
            if ($businessInfo->verified == 2 && $post->isEmpty())
            {
                // was declined
                $model = $users->useRule('BecomeAPartnerRule', $businessInfo->join()->from('users_information', 'userid')->get());

                Centurion\Models\Input::pass($model);
            }
        }
        
		$this->render('becomeapartner');
	}
}
// END class 