<?php

use Moorexa\Route;
use Moorexa\Event;
use Moorexa\Registry;
use Moorexa\Bootloader;
use Moorexa\DB;
use Moorexa\Middleware;

/*
 ***************************
 * 
 * @ Route
 * info: Add your GET, POST, DELETE, PUT request handlers here. 
*/

Route::any('change-password-{activationcode}', ['activationcode' => '/([\S]+)/'], function($activationcode)
{
    return 'app/changePassword/'.$activationcode;
});

// resend activation route
Route::get('resend-activation-link', function($route)
{
    // apply guard
    $route->guard('sessionLogin@hasSessionToken');

    // get previous link
    list($controller, $view) = array_values((array) uri()->previous());

    // send email again to customer
    Centurion\Helpers\Email::resendActivationLink($controller, $view);

    // is authenticated
    return $controller . '/' . $view;
    
});

// complete registration
Route::get('complete-registration/{activationCode}', function($activationCode)
{
    // ignore session login guard
    Guards::ignore('sessionLogin@hasSessionToken');

    // check activation code
    $validActivationCode = Centurion\Helpers\Query::checkActivationCode($activationCode);

    // success message
    $message = 'Your account has been activated successfully.';

    if ($validActivationCode)
    {
        // run statisfied 
        $validActivationCode->update(['satisfied' => 1]);

        // now we update authentication table
        $validActivationCode->from('authentication', 'userid')->update(['isactivated' => 1]);

        // get guard
        $guard = boot()->get('Guards');

        // was a success
        Centurion\Helpers\Alert::toastDefaultSuccess($message);

        if ($guard->sessionLogin()->isAuthenticated())
        {
            $user = $validActivationCode->from('users')->get();

            // get account base url
            $baseurl = $user->from('accounts', 'accountid')->pick('account_base_url');

            // get controller and view
            list($controller, $view) = explode('/', $baseurl);

            // load hasSessionToken
            $guard->sessionLogin()->hasSessionToken();

            return $controller . '/' . $view;
        }

        return 'App/login';
    }

    return 'App/home';
});

// switch account
Route::get('switch-to-{account}', function($account, Route $route)
{
    // get guard
    $guard = boot()->get('Guards');

    // is this user loggedin
    if ($guard->sessionLogin()->isAuthenticated())
    {
        // user must be a customer or a partner
        // load hasSessionToken
        $guard->sessionLogin()->hasSessionToken();

        $redirectDefault = true;

        if (Centurion\Helpers\Query::isCustomerOrPartner())
        {
            // get accountid
            $newAccount = Centurion\Helpers\Query::getAccountInformation($account);
            
            if ($newAccount->rows > 0)
            {
                // update accountid
                Guards::user()->update(['accountid' => $newAccount->accountid]);

                $redirectDefault = false;

                // redirect user
                $route->redir($newAccount->account_base_url);
            }
        }

        if ($redirectDefault)
        {
            // redirect user
            $route->redir(Guards::account()->account_base_url);
        }
    }   

    // add to redirection
    session()->set('redirectTo', 'switch-to-'. $account);

    // login to account
    return 'app/login';
});

function checkAuthThenRedirect(closure $callback)
{
    // get guard
    $guard = boot()->get('Guards');

    // is this user loggedin
    if ($guard->sessionLogin()->isAuthenticated())
    {
        return call_user_func($callback);
    }

    // add to redirection
    session()->set('redirectTo', uri()->pathAsSeen());

    // login to account
    return 'app/login';
}

// add a room
Route::any('add-a-room-to-{listingid}', function($listingid){

    return checkAuthThenRedirect(function() use ($listingid){
        return 'partner/rooms/add/' . $listingid;
    });

});

// lock a room
Route::get('lock-room-{listingig}/{roomid}', function($listingid, $roomid)
{
    return checkAuthThenRedirect(function() use ($listingid, $roomid){
        return 'partner/listing/property/edit/' . $listingid . '/lock/' . $roomid;
    });
});

// unlock a room
Route::get('unlock-room-{listingig}/{roomid}', function($listingid, $roomid)
{
    return checkAuthThenRedirect(function() use ($listingid, $roomid){
        return 'partner/listing/property/edit/' . $listingid . '/unlock/' . $roomid;
    });
});

// load property
Route::get('property-{propertytype}', function($propertytype){
   // load all property types
   $types = db('property_types')->get();
   $allTypes = [];
   
   $types->obj(function($row) use (&$allTypes){
        $allTypes[strtolower($row->propertytype)] = $row;
   });

   if (isset($allTypes[$propertytype]))
   {
       return 'app/property/' . $allTypes[$propertytype]->propertytype;
   }

});