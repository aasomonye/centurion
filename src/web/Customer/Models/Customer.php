<?php
namespace Moorexa;

use Moorexa\DB;
use Moorexa\Event;
use Centurion\Models\Users;
use Centurion\Models\Input;
use WekiWork\Fileio;
use Centurion\Helpers\Alert;

/**
 * Customer model class auto generated.
 *
 *@package	Customer Model
 *@author  	Moorexa <www.moorexa.com>
 **/

class Customer extends Model
{
    
    // set up database structure
    public function postBecomeAPartner(Users $user)
    {
        $proceessed = false;
        $canContinue = false;
        $action = 'create';

        // get rule
        $model = $user->useRule('BecomeAPartnerRule');

        if ($model->isOk())
        {
            // pick userid
            $user = $model->pick('userid')->setTable('business_information', 'userid');

            // check if request hasn't been previously submitted
            if (!$user->exists())
            {
                $canContinue = true;
            }
            else
            {
                if ($user->lastQuery()->verified == 2)
                {
                    $action = 'update';
                    $canContinue = true;
                }
            }

            // can we continue ?
            if ($canContinue)
            {
                $upload = new Fileio();
                
                // upload cac certificate
                $upload->upload('cac_certificate')
                ->to(CUSTOMER_PATH . 'Static/Uploads/', function($name, $filepath) use (&$model)
                {
                    // set path
                    $model->setVal($name, $filepath);
                }); 

                // pick users_information
                $usersinfo = $model->pick('account_name', 'account_number', 'bank_name', 'bank_swift_code', 'userid');

                // pick business information
                $businessinfo = $model->pick('cac_certificate', 'business_name', 'contact_address', 'contact_phone',
                'contact_email', 'about_business', 'userid', 'tin_number');

                // run update for usersinfo
                if ($usersinfo->setTable('users_information', 'userid')->update())
                {
                    if ($action != 'update')
                    {
                        // add business information
                        if ($businessinfo->setTable('business_information')->create())
                        {
                            $model->clear();
                            $proceessed = true;
                        }
                    }
                    else
                    {
                        // update business information
                        $businessinfo->verified = 0;
                        if ($businessinfo->setTable('business_information', 'userid')->update())
                        {
                            $proceessed = true;
                        }
                    }
                }
            }
            else
            {
                Alert::toastDefaultError('You have a pending verification and cannot resubmit application.');
            }
        }

        Input::pass($model);

        return $proceessed;
    }
}