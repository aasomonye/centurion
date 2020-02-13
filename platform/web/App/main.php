<?php
use Moorexa\Model;
use Moorexa\Packages as Package;
use Moorexa\Controller;
use Centurion\Models\Table;
use Centurion\Models\Users;
use Centurion\Models\Input;
use Centurion\Helpers\Alert;

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
        if ($this->has('loginMessage'))
        {
            Alert::toastDefaultSuccess($this->loginMessage);
        }

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
        if ($this->has('resetPasswordMessage'))
        {
            Alert::toastDefaultSuccess($this->resetPasswordMessage);
        }

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
                    $this->redir('dashboard/complete-registration', $response);
                }
            }    
        });
        
		$this->render('account/register');
	}
	/**
    * @method App changePassword
    *
    * See documentation https://www.moorexa.com/doc/controller
    *
    * You can catch params sent through the $_GET request
    * @return void
    **/

	public function changePassword($activationCode, Table $table, Users $user)
	{
        if ($activationCode == null)
        {
            // redirect user to the login page.
            $this->redir('login');
        }

        // check activation code
        $model = $table->useRule('Activation');

        // add activation code 
        $model->activation_code = $activationCode;

        // check
        if ($model->identity('activation_code')->exists())
        {
            // password has been changed with this activation code previously?
            if ($model->satisfied == 1)
            {
                // opps! that code cannot be reused. user needs to initiate a new password reset request.
                $this->redir('reset-password', 'Activation code expired! Please initiate a new request');
            }

            // process password recovery 
            $this->model->processPasswordRecovery($model, $user);
        }

        // render view
		$this->render('account/changepassword');
	}
}
// END class