<?php

/**
 * @package SessionLoginAuth
 * @author  Moorexa Assist
 */

class SessionLoginAuth extends Authenticate
{
    // allow specific requests
    public $allow = ['App']; 

    // allow all except this requests
    public $allowAllExcept = [];

    // #code here.
    public function hasSessionToken()
    {
        // perform redirection
        $redirect = true;

        if (session()->has('session.token', $token))
        {
            // get user id
            $authentication = db('authentication')->get('session_token = ?', $token);

            if ($authentication->rows > 0)
            {
                $redirect = false;
            }

            if ($redirect)
            {
                if (cookie()->has('remember_me_cookie', $cookieValue))
                {
                    $hasCookie = $authentication->get('remember_me_cookie = ?', $cookieValue);

                    if ($hasCookie->rows > 0)
                    {
                        $redirect = false;
                    }
                }
            }

            if (!$redirect)
            {
                Authenticate::setID($authentication->userid)->setMethod(
                    [
                        'logout' => function() use ($authentication)
                        {
                            // remove token and cookie
                            $authentication->update([
                                'session_token' => '',
                                'remember_me_cookie' => ''
                            ]);

                            // manage last login
                            $authentication->from('login_tracker', 'authenticationid')->update(['isloggedin' => 0]);

                            // remove cookie
                            if (cookie()->has('remember_me_cookie'))
                            {
                                // drop it
                                cookie()->drop('remember_me_cookie');
                            }

                            // redirect user to login page
                            $this->redir('login', 'Your logout was successful.');
                        },
                        'user' => 'users',
                        'info' => 'users_information'
                    ]
                );
            }
        }


        if ($redirect)
        {
            $this->redir('login', 'Session expired. Please login again.');
        }
    }
}