<?php

// use Moorexa\Model;
// use Moorexa\Packages as Package;

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
}
// END class