<?php

// use Moorexa\Model;
// use Moorexa\Packages as Package;
use Guards as Auth;
use Centurion\Helpers\UI;
use Centurion\Helpers\Alert;

/**
 * Documentation for Dashboard Page can be found in Dashboard/readme.txt
 *
 *@package	Dashboard Page
 *@author  	Moorexa <www.moorexa.com>
 **/

class Dashboard extends Moorexa\Controller
{
	/**
    * @method Dashboard home
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
    * @method Dashboard welcome
    *
    * See documentation https://www.moorexa.com/doc/controller
    *
    * You can catch params sent through the $_GET request
    * @return void
    **/

	public function welcome()
	{
		$this->render('welcome');
	}
	/**
    * @method Dashboard logout
    *
    * See documentation https://www.moorexa.com/doc/controller
    *
    * You can catch params sent through the $_GET request
    * @return void
    **/

	public function logout()
	{
        // kill session
        Auth::logout();
	}
	/**
    * @method Dashboard completeRegistration
    *
    * See documentation https://www.moorexa.com/doc/controller
    *
    * You can catch params sent through the $_GET request
    * @return void
    **/

	public function completeRegistration()
	{
        UI::pageTitle('Account Update');

        $this->modelAction('postCompleteRegistration', function($status, $account){
            if ($status)
            {
                $this->redir($account->account_base_url, 'Your profile has been updated successfully.');
            }
        });

		$this->render('completeregistration');
	}
	/**
    * @method Dashboard profile
    *
    * See documentation https://www.moorexa.com/doc/controller
    *
    * You can catch params sent through the $_GET request
    * @return void
    **/

	public function profile()
	{
		$this->render('profile');
	}
}
// END class