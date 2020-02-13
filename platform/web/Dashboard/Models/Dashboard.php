<?php
namespace Moorexa;

use Moorexa\DB;
use Moorexa\Event;
use Centurion\Models\Users;
use Centurion\Models\Input;
use Guards as Auth;
use Centurion\Helpers\Alert;

/**
 * Dashboard model class auto generated.
 *
 *@package	Dashboard Model
 *@author  	Moorexa <www.moorexa.com>
 **/

class Dashboard extends Model
{
    // process complete registration form
    public function postCompleteRegistration(Users $user)
    {
        // set model rule for user.
        $model = $user->useRule('UserInformationRule');

        if ($model->isOk())
        {
            if ($model->create())
            {
                return $this->parameters(true, Auth::user()->from('accounts', 'accountid')->get());
            }
        }

        // push input to views
        Input::pass($model);

        return $this->parameters(false, null);
    }

    // process profile update
    public function postProfile(Users $user)
    {
        $model = $user->useRule('profileUpdateRule');

        // required for users table update
        $userData = $model->pick('firstname', 'lastname', 'userid');

        // required for users_information
        $usersInfoData = $model->pick('home_address', 'work_address');

        if ($model->isOk())
        {
            // update users table
            if ($userData->update())
            {
                // all good
                Alert::toastDefaultSuccess('Profile updated successfully.');

                $query = $userData->getQuery(); // get last query ran for $userData

                // check if users information has been submitted previously
                if ($query->from('users_information', 'userid')->get()->rows > 0)
                {
                    // update table 
                    $query->lastQuery()->update($usersInfoData);
                }
            }
        }

        Input::pass($model);
    }
}