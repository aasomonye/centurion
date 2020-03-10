<?php
namespace Moorexa;

use Moorexa\DB;
use Moorexa\Event;
use Centurion\Models\Users;
use Centurion\Models\Input;
use Centurion\Helpers\Email;
use Centurion\Helpers\Query;
use Centurion\Helpers\Alert;
use Centurion\Models\Table;
use Moorexa\InputData\Rule;
use Guards as Auth;

/**
 * App model class auto generated.
 *
 *@package	App Model
 *@author  	Moorexa <www.moorexa.com>
 **/

class App extends Model
{

    // register a user
    public function postRegister(Users $model)
    {
        $model = $model->useRule('RegisterRule');

        if ($model->isOk())
        {
            $model->nationalityid = 1;

            // remove password from rule
            $password = $model->pop('password');
            // remove password again
            $password_again = $model->pop('password_again');  

            if ($password == $password_again)
            {
                // check if account do not exists
                if (!$model->exists())
                {
                    // get lock status for new account
                    $lock = Query::getLockByStatus('new account');
                    
                    // check for account by email address
                    $emailExists = Query::getUserByEmail($model->email_address);

                    if ($emailExists->rows == 0)
                    {
                        // get customer accountid
                        $model->accountid = Query::getCustomerAccount();
                        
                        // create account
                        if ($model->create($userid))
                        {
                            $activationcode = mt_rand(10000, 1000000);

                            // activation data
                            $activationData = [
                                'userid' => $userid,
                                'activation_code' => $activationcode,
                                'redirect_to' => $lock->lock_screen_link,
                                'satisfied' => 0,
                                'lockid' => $lock->lockid
                            ];

                            // generate password salt
                            $password_salt = $this->generateSalt($password);

                            // authentication table
                            $authentication = [
                                'userid' => $userid,
                                'password_salt' => $password_salt,
                                'password_hash' => Hash::digest($password_salt . '::' . $password),
                                'remember_me_cookie' => '',
                                'lockid' => $lock->lockid
                            ];

                            // add authentication
                            $authenticate = Query::applyAuthenticationRecordForUser($authentication);

                            // add activation data
                            Query::applyActivationRecordForUser($activationData);

                            // set user id for mail
                            Email::$userid = $userid;

                            // prepare email template
                            Email::getTemplate('onboarding', [
                                'name' => ucwords($model->firstname . ' ' . $model->lastname),
                                'link' => url('complete-registration/'.$activationcode),
                                'year' => date('Y')
                            ])->send('Welcome to Centurion', $model->email_address);

                            // pass password on.
                            $model->password = $password;

                            // add to login tracker
                            Query::applyLoginTrackForRegistration([
                                'authenticationid' => $authenticate->id
                            ]);

                            return $this->parameters('Your account has been registered successfully. Please check your mail for activation', $model);
                        }
                    }

                    Alert::toastDefaultError('Registration failed. Email already in use.');
                }

                Alert::toastDefaultError('Registration failed. Account exits, please login instead');
            }

            Alert::toastDefaultError('Password do not match. Please try again please.');
        }
        
        // pass to view
        Input::pass($model);

        return false;
    }

    // login a user. receive username and password
    public function postLogin(Users $model)
    {
        $model = $model->useRule('LoginRule');
        
        if ($model->isOk())
        {
            $login = $this->performAutoLogin($model);

            if ($login->status == 'success')
            {
                // redirection url
                $redirectionUrl = $login->redirection;

                // check if user information has been submitted
                if ($login->userInfo->rows == 0)
                {
                    $redirectionUrl = 'dashboard/complete-registration';
                }

                $this->redir($redirectionUrl, $login->message);
            }

            Alert::toastDefaultError($login->message);
        }

        Input::pass($model);    
    }

    // perform auto login
    public function performAutoLogin(Users $model)
    {
        // get username and password
        $username = $model->email_address;
        $password = $model->password;

        $response = (object)[];

        if ($username != null)
        {
            $hasAccount = Query::getUserByEmail($username);

            $response->status = 'error';
            $response->message = 'invalid username';
            $response->redirection = 'dashboard';

            if ($hasAccount->rows > 0)
            {
                // get authentication by id
                $authentication = $hasAccount->from('authentication', 'userid')->get();

                // get password salt
                $passwordSalt = $authentication->password_salt;

                // get password hash
                $passwordHash = $authentication->password_hash;

                // build password
                $passwordString = $passwordSalt . '::' . $password;

                // update response status
                $response->message = 'incorrect password';

                // verify password
                if (Hash::verify($passwordString, $passwordHash))
                {
                    // generate a new salt
                    $newSalt = $this->generateSalt($password);

                    // generate session token
                    $sessionToken = md5($username . $newSalt . time() . $password);

                    // set session token
                    session()->set('session.token', $sessionToken);

                    // update salt
                    $authentication->update(['password_salt' => $newSalt, 
                    'session_token' => $sessionToken, 
                    'password_hash' => Hash::digest($newSalt . '::' . $password)
                    ]);

                    if ($model->has('remember'))
                    {
                        $cookieToken = sha1(time() * mt_rand(10, 100) . str_shuffle($sessionToken));

                        // update cookie value
                        $authentication->update(['remember_me_cookie' => $cookieToken]);
                        
                        // add cookie
                        cookie()->set('remember_me_cookie', $cookieToken);
                    }

                    $response->status = 'success';
                    $response->message = 'Login successful';
                    $response->userInfo = $authentication->from('users_information', 'userid')->get();

                    // check for rediretion url
                    if ($authentication->lockid == 0)
                    {
                        // just get account redirection url
                        $account = $hasAccount->from('accounts')->get();
                        $response->redirection = $account->account_base_url;
                    }
                    else
                    {
                        $lockStatus = $authentication->from('lock_status', 'lockid')->get();
                        $response->message = $lockStatus->lock_note;
                        $response->redirection = $lockStatus->lock_screen_link;
                    }

                    // check if we have a redirect to request
                    if (session()->has('redirectTo', $redirectionUrl))
                    {
                        $response->redirection = $redirectionUrl;
                        
                        // remove request
                        session()->drop('redirectTo');
                    }

                    // add login tracker
                    $authentication->from('login_tracker', 'authenticationid')->update([
                        'isloggedin' =>  1,
                        'last_login' => date('Y-m-d g:i:s a')
                    ]);
                }
            }
        }

        return $response;
    }

    // generate password salt
    public function generateSalt(string $string)
    {
       // generate random number
       $randomNumber = mt_rand(10000, 1000000);

       // get salt
       $salt = env('bootstrap', 'csrf_salt');

       // shuffle salt
       $salt = str_shuffle($salt);

       // encrypt
       return sha1(encrypt(time() . $string . '@' . $salt . $randomNumber));
    }

    // reset password
    public function postResetPassword(Users $model, Table $table)
    {
        $model = $model->useRule('ResetPasswordRule');
        
        if ($model->isOk())
        {
            // check for email existance
            if ($model->exists())
            {
                // send email reset url
                // get user information
                $user = Query::getUserByEmail($model->email_address);

                // get the password salt
                $authentication = Query::getAuthenticationByUserId($user->userid);

                // generate activation code
                $activationCode = sha1(time() * 60 . $model->email_address . $authentication->password_salt);

                // get the lock status we want to use
                $lockStatus = Query::getLockByStatus('password reset');

                // add to activation table
                $activation = $table->useRule('Activation');
                $activation->lockid = $lockStatus->lockid;
                $activation->activation_code = $activationCode;
                $activation->redirect_to = 'dashboard';
                $activation->userid = $user->userid;

                if ($activation->isOk())
                {
                    $activation->create(); 

                    // send to user email account
                    $replace = [
                        'ipaddress' => $_SERVER['REMOTE_ADDR'],
                        'date' => date('jS F Y g:i a'),
                        'link' => url('change-password-'.$activationCode),
                        'year' => date('Y')
                    ];

                    // send email out
                    Email::getTemplate('password reset', $replace)->send('Password Reset', $user->email_address);

                    // redirect to login page with a message
                    $this->redir('login', 'A mail has been sent to you, please check your inbox to complete password reset.');
                }

                Alert::toastDefaultError('An error occured. Please check activation rules');
            }

            Alert::toastDefaultError('Email address not linked to any account. Please check and try again.');
        }

        Input::pass($model);
    }

    // process password recovery
    public function processPasswordRecovery($model, Users $user)
    {
        $userModel = $user->useRule('PasswordRecoveryRule');

        if ($userModel->isOk())
        {
            // do they match
            if ($userModel->password == $userModel->password_again)
            {
                // get user authentication record 
                $authentication = $model->getQuery()->from('authentication', 'userid')->get();
                
                // now we generate a new salt for this user
                $password_salt = $this->generateSalt($userModel->password);

                // generate password hash
                $updateArray = [
                    'password_hash' => Hash::digest($password_salt . '::' . $userModel->password),
                    'password_salt' => $password_salt
                ];

                // now update user authentication table and redirect user to @model redirect_to page with a message
                if ($authentication->update($updateArray)->ok)
                {
                    // action has been satisfied, so we update
                    $model->satisfied = 1;
                    $model->update();

                    if (!Auth::isLoggedin())
                    {
                        $model->redirect_to = 'login';
                    }

                    // redirect user.
                    $this->redir($model->redirect_to, 'Your password was changed successfully. Thank you for using this channel.');
                }
            }

            $userModel->clear(); // clear entries

            // oops! failed
            Alert::toastDefaultError('Password provided do not match. Please try again');
        }

        // pass entries back to form.            
        Input::pass($userModel);   
    }
}