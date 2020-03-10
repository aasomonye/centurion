<?php

use Moorexa\Rexa;

/**
 * @package SessionLoginGuard
 * @author  Moorexa Assist
 */

class SessionLoginGuard extends Guards
{
    // allow specific requests
    public $allow = ['App']; 

    // allow all except this requests
    public $allowAllExcept = [];

    // #code here.
    public function hasSessionToken()
    {
        // perform redirection
        $isloggedin = $this->isAuthenticated($authentication);

        if ($isloggedin)
        {
            Guards::setID($authentication->userid)->setMethod(
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
                'info' => 'users_information',
                'isLoggedin' => true,
                'account' => function()
                {
                    // get user information
                    $user = Guards::user();
                    return $user->from('accounts', 'accountid')->get();
                }
            ]
            ); 

            // load diretives for accounts
            $this->loadDirectives();
        }
        
        if ($isloggedin === false)
        {
            $this->redir('login', 'Session expired. Please login again.');
        }
    }

    // is authenticated
    public function isAuthenticated(&$authentication=null)
    {
        $isloggedin = false; // user not loggedin

        if (session()->has('session.token', $token))
        {
            // get user id
            $authentication = db('authentication')->get('session_token = ?', $token);

            if ($authentication->rows > 0)
            {
                $isloggedin = true;
            }

            $cookieValue = null;

            if ($isloggedin === false)
            {
                if (cookie()->has('remember_me_cookie', $cookieValue))
                {
                    $hasCookie = $authentication->get('remember_me_cookie = ?', $cookieValue);

                    if ($hasCookie->rows > 0)
                    {
                        $isloggedin = true;
                    }
                }
            }
        }

        return $isloggedin;
    }

    private function loadDirectives()
    {
        // get all accounts
        $accounts = db('accounts')->get();

        $accounts->obj(function($account)
        {
            Rexa::directive('if'.ucfirst($account->account_name), function() use ($account)
            {
                $currentUser = false;

                // check current user id
                if ($account->accountid == Guards::account()->accountid)
                {
                    $currentUser = true;
                }

                return '<?php if ('.$account->accountid.' == Guards::account()->accountid) { ?>';
            }); 
        });
    }
}