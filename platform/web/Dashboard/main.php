<?php

// use Moorexa\Model;
// use Moorexa\Packages as Package;
use Authenticate as Auth;

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
}
// END class