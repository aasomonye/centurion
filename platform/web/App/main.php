<?php
use Moorexa\Model;
use Moorexa\Packages as Package;
use Moorexa\Controller;
/**
 * Documentation for App Page can be found in App/readme.txt
 *
 *@package	App Page
 *@author  	Moorexa <www.moorexa.com>
 **/

class App extends Controller
{
	/**
    * App/home wrapper. 
    *
    * See documention https://www.moorexa.com/doc/controller
    *
    * @param Any You can catch params sent through the $_GET request
    * @return void
    **/

	public function home()
	{
		
		$this->render('home');
	}
	/**
    * App/contact wrapper. 
    *
    * See documention https://www.moorexa.com/doc/controller
    *
    * @param Any You can catch params sent through the $_GET request
    * @return void
    **/

	public function contact()
	{
		$this->render('contact');
	}
	/**
    * App/become-a-partner wrapper. 
    *
    * See documention https://www.moorexa.com/doc/controller
    *
    * @param Any You can catch params sent through the $_GET request
    * @return void
    **/

	public function becomeAPartner()
	{
        $this->default = true;
        
        // test mail client
        $email = Centurion\Helpers\Email::getTemplate('password reset', ['link' => 'google.com']);
        $email->send('Password Recovery', 'helloamadiify@gmail.com');

		$this->render('becomeapartner');
	}
	/**
    * App/car-rental wrapper. 
    *
    * See documention https://www.moorexa.com/doc/controller
    *
    * @param Any You can catch params sent through the $_GET request
    * @return void
    **/

	public function carRental()
	{
		$this->render('carrental');
	}
	/**
    * App/login wrapper. 
    *
    * See documention https://www.moorexa.com/doc/controller
    *
    * @param Any You can catch params sent through the $_GET request
    * @return void
    **/

	public function login()
	{   
		$this->render('account/login');
	}
	/**
    * App/reset-password wrapper. 
    *
    * See documention https://www.moorexa.com/doc/controller
    *
    * @param Any You can catch params sent through the $_GET request
    * @return void
    **/

	public function resetPassword()
	{
		$this->render('account/resetpassword');
	}
	/**
    * App/register wrapper. 
    *
    * See documention https://www.moorexa.com/doc/controller
    *
    * @param Any You can catch params sent through the $_GET request
    * @return void
    **/

	public function register()
	{
        $this->modelAction('postRegister', function($response, $users)
        {
            if ($response !== false)
            {
                // registration was successful.
                $canLogin = $this->model->performAutoLogin($users);

                if ($canLogin->status == 'success')
                {
                    $this->redir('dashboard/welcome', $response);
                }
            }    
        });
        
		$this->render('account/register');
	}
}
// END class