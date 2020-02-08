<?php
namespace Moorexa;

use Moorexa\DB;
use Moorexa\Event;
use Centurion\Models\Users;
use Centurion\Models\Input;
use Centurion\Helpers\Email;
use Centurion\Helpers\Query;
use Bootstrap\Alert;

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
                            ]);//->send('Welcome to Centurion', $model->email_address);

                            // pass password on.
                            $model->password = $password;

                            // add to login tracker
                            Query::applyLoginTrackForRegistration([
                                'authenticationid' => $authenticate->id
                            ]);

                            return $this->parameters('Your account has been registered successfully. Please check your mail for activation', $model);
                        }
                    }

                    Alert::error('Registration failed. Email already in use.');
                }

                Alert::error('Registration failed. Account exits, please login instead');
            }

            Alert::error('Password do not match. Please try again please.');
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
                $this->redir($login->redirection, $login->message);
            }

            Alert::error($login->message);
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
                    $authentication->update(['password_salt' => $newSalt, 'session_token' => $sessionToken]);

                    if ($model->has('remember'))
                    {
                        $cookieToken = sha1(str_shuffle($sessionToken));

                        // update cookie value
                        $authentication->update(['remember_me_cookie' => $cookieToken]);
                        
                        // add cookie
                        cookie()->set('remember_me_cookie', $cookieToken);
                    }

                    $response->status = 'success';
                    $response->message = 'Login successful';

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
}