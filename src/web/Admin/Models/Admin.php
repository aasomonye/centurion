<?php
namespace Moorexa;

use Moorexa\DB;
use Moorexa\Event;
use Centurion\Models\Users;
use Centurion\Models\Table;
use Centurion\Helpers\Query;
use Centurion\Helpers\Email;

/**
 * Admin model class auto generated.
 *
 *@package	Admin Model
 *@author  	Moorexa <www.moorexa.com>
 **/

class Admin extends Model
{
    // triggers
    public $triggers = [
        'users' => ['revoke' => 'get:RevokeUserAccess', 'as-admin' => 'get:MakeUserAdmin'],
        'partners' => ['approve' => 'get:ApprovePartnership', 'decline' => 'get:DeclinePartnership']
    ];

    // revoke user access
    public function RevokeUserAccess($userid, Users $users) : bool
    {
        // revoked ?
        $revoked = false;

        // use RevokeAdminToUser rule
        $model = $users->useRule('RevokeAdminToUser', $userid);

        if ($model->isOk())
        {
            // run update
            $model->update();

            // check userid and auto log user out if current id matches revoked id
            if ($userid == \Guards::id())
            {
                // auto logout
                \Guards::logout();
            }

            // revoked
            $revoked = true;
        }

        return $revoked;
    }

    // make user super admin
    public function MakeUserAdmin($userid, Users $users) : bool
    {
        // migrated 
        $migrated = false;

        // use UserToAdmin rule
        $model = $users->useRule('UserToAdmin', $userid);

        if ($model->isOk())
        {
            // run update
            $model->update();
            $migrated = true;
        }

        return $migrated;
    }

    // approve partnership request
    public function ApprovePartnership($userid, Table $table) : bool
    {
        $processed = false;

        // use rule
        $model = $table->useRule('PartnerVerification', $userid);

        // set verification state
        $model->setVal('verified', Table::VERIFIED);

        // set identity
        $model->identity('userid');

        if ($model->isOk())
        {
            // ensure account exists
            if ($model->pick('userid')->exists())
            {
                // have user been approved previously?
                if (!$model->exists())
                {
                    // approve user
                    $model->update();

                    // update user account
                    $user = $model->lastQuery()->from('users')->get();
                    $user->update(['accountid' => Query::getPartnerAccount()]);

                    // send email to user
                    Email::getTemplate('partnership approved', [
                        'year' => date('Y')
                    ])->send('Partnership Approved', $user->email_address);

                    $processed = true;
                }
            }
        }

        return $processed;
    }

    // decline partnership request
    public function DeclinePartnership($userid, Table $table) : bool
    {
        $processed = false;

        // use rule
        $model = $table->useRule('PartnerVerification', $userid);

        // set verification state
        $model->setVal('verified', Table::DECLINED);

        // set identity
        $model->identity('userid');

        if ($model->isOk())
        {
            // ensure account exists
            if ($model->pick('userid')->exists())
            {
                // have user been declined previously?
                if (!$model->exists())
                {
                    // decline user
                    $model->update();

                    // update user account
                    $user = $model->lastQuery()->from('users')->get();
                    $user->update(['accountid' => Query::getCustomerAccount()]);

                    // send email to user
                    Email::getTemplate('partnership declined', [
                        'year' => date('Y')
                    ])->send('Partnership Declined', $user->email_address);

                    $processed = true;
                }
            }
        }

        return $processed;
    }

    // approve listing
    public function approveListing(int $listingid)
    {
        // approve listing
        $listing = $this->query->getListingById($listingid);
        $approved = false;

        if ($listing->update(['approved' => 1])->ok)
        {
            // possibly, send a message to user.
            $approved = true;
        }

        return $approved;
    }

    // suspend listing
    public function suspendListing(int $listingid)
    {
        // suspend listing
        $listing = $this->query->getListingById($listingid);
        $approved = false;

        if ($listing->update(['approved' => 2])->ok)
        {
            // possibly, send a message to user.
            $approved = true;
        }

        return $approved;
    }

    // bookable listing
    public function bookableListing(int $listingid)
    {
        return $this->approveListing($listingid);
    }
}