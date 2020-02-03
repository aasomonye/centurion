<?php
use Moorexa\Model;
use Moorexa\Packages as Package;
use Moorexa\Controller;
/**
 * Documentation for PageError Page can be found in PageError/readme.txt
 *
 *@package	PageError Page
 *@author  	Moorexa <www.moorexa.com>
 **/

class PageError extends Controller
{
	/**
    * PageError/home wrapper. 
    *
    * See documention https://www.moorexa.com/doc/controller
    *
    * @param Any You can catch params sent through the $_GET request
    * @return void
    **/

	public function error404()
	{
		$this->render('error404');
	}
}
// END class