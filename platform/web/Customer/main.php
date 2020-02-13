<?php

// use Moorexa\Model;
// use Moorexa\Packages as Package;

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
}
// END class