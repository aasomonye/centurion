<?php

// use Moorexa\Model;
// use Moorexa\Packages as Package;
use Centurion\Helpers\UI;
use Centurion\Helpers\Alert;

/**
 * Documentation for Partner Page can be found in Partner/readme.txt
 *
 *@package	Partner Page
 *@author  	Moorexa <www.moorexa.com>
 **/

class Partner extends Moorexa\Controller
{
	/**
    * @method Partner home
    *
    * See documentation https://www.moorexa.com/doc/controller
    *
    * You can catch params sent through the $_GET request
    * @return void
    **/

	public function home()
	{
		$this->redir('partner/dashboard');
	}
	/**
    * @method Partner dashboard
    *
    * See documentation https://www.moorexa.com/doc/controller
    *
    * You can catch params sent through the $_GET request
    * @return void
    **/

	public function dashboard()
	{
		$this->render('dashboard');
	}
	/**
    * @method Partner listing
    *
    * See documentation https://www.moorexa.com/doc/controller
    *
    * You can catch params sent through the $_GET request
    * @return void
    **/

	public function listing($listingType, $action, $listingid, $roomAction, $roomid)
	{
        // allowed actions
        $allowedActions = ['list' => 'Add a property', 'view' => 'View property'];

        $view = UI::generateViewPath('partner/listing', $listingType, function($view){
            UI::pageTitle(ucwords($view) . ' Listing');
        });

        // do we have a action view ?
        if ($action !== null && isset($allowedActions[$action]))
        {
            // change view path
            $view .= '/' . $action;
            
            // change page title
            UI::pageTitle($allowedActions[$action]);
        }

        if (in_array($action, ['edit', 'remove']))
        {
            // check if listing id exists, then proceed.
            if ($this->query->listingExists($listingid, $listinginfo))
            {
                // decode json string
                $info = json_decode($listinginfo->listing_information);

                // get listing title
                $title = $listinginfo->listing_type == 'property' ? $info->property_name : $info->car_name;

                // edit breadcum
                UI::breadcrumb([$listingid => ucwords($title)]);

                if ($action == 'remove')
                {
                    // use confirm manager
                    $delete = UI::confirmDelete('Are you sure you want to remove listing from your account ?');

                    if ($delete)
                    {
                        if ($this->removeFromListing($listingid, $listinginfo))
                        {
                            Alert::toastDefaultSuccess(ucwords($title) . ' was removed successfully from '.strtolower($listingType).'.');
                        }
                    }
                }
                else
                {
                    $view .= '/' . $action;
                    UI::pageTitle('Manage ' . ucwords($title));
                }

                // check for room action
                if ($roomAction != null)
                {
                    $this->setActive = 'rooms';

                    switch ($roomAction)
                    {
                        case 'lock':
                            // get room title
                            $roomTitle = isset($info->property_room_title[$roomid]) ? $info->property_room_title[$roomid] : null;
                            
                            if ($roomTitle !== null)
                            {
                                // use confirm manager
                                $lock = UI::confirmDelete('Are you sure you want to lock '.$roomTitle.'?');

                                if ($lock)
                                {
                                    $lockData = isset($info->room_locks) ? $info->room_locks : (object)[];
                                    $lockData->{$roomid} = 1;
                                    $info->room_locks = $lockData;
                                    // save now
                                    if ($listinginfo->update(['listing_information' => json_encode($info)])->ok)
                                    {
                                        Alert::toastDefaultSuccess(ucfirst($roomTitle). ' locked successfully.');
                                    }
                                }
                            }
                        break;

                        case 'unlock':
                            // get room title
                            $roomTitle = isset($info->property_room_title[$roomid]) ? $info->property_room_title[$roomid] : null;
                            
                            if ($roomTitle !== null)
                            {
                                // use confirm manager
                                $lock = UI::confirmDelete('Are you sure you want to unlock '.$roomTitle.'?');

                                if ($lock)
                                {
                                    $lockData = isset($info->room_locks) ? $info->room_locks : (object) [];
                                    unset($lockData->{$roomid});
                                    $info->room_locks = $lockData;
                                    // save now
                                    if ($listinginfo->update(['listing_information' => json_encode($info)])->ok)
                                    {
                                        Alert::toastDefaultSuccess(ucfirst($roomTitle). ' unlocked successfully.');
                                    }
                                }
                            }
                        break;
                    }
                }
            }   
        }

        $this->modelAction('postPropertyList', function($response)
        {
            if ($response)
            {
                Alert::toastDefaultSuccess('Property listed successfully.');
            }
        });

		$this->render($view);
	}
	/**
    * @method Partner rooms
    *
    * See documentation https://www.moorexa.com/doc/controller
    *
    * You can catch params sent through the $_GET request
    * @return void
    **/

	public function rooms($action, $listingid)
	{
        $allowedActions = ['add' => 'Add a room', 'edit' => 'Edit Room'];
        $view = 'partner/rooms';

        if ($action != null && $listingid != null)
        {
            if (isset($allowedActions[$action]))
            {
                $view = $view . '/' . $action;

                // change page title
                UI::pageTitle($allowedActions[$action]);
            }

            // check if listing id exists, then proceed.
            if ($this->query->listingExists($listingid, $listinginfo))
            {
                // decode json string
                $info = json_decode($listinginfo->listing_information);

                // get listing title
                $title = $listinginfo->listing_type == 'property' ? $info->property_name : $info->car_name;

                // edit breadcum
                UI::breadcrumb([$listingid => ucwords($title)]);
            } 

            $this->modelAction('postRoomsAdd', function($response)
            {
                if ($response)
                {
                    Alert::toastDefaultSuccess('Room added successfully.');
                }
            });
        }
        else
        {
            $this->redir('listing');
        }

		$this->render($view);
	}
	/**
    * @method Partner editProperty
    *
    * See documentation https://www.moorexa.com/doc/controller
    *
    * You can catch params sent through the $_GET request
    * @return void
    **/

	public function editProperty($listingid)
	{
        // check if listing id exists, then proceed.
        if ($listingid !== null && $this->query->listingExists($listingid, $listinginfo))
        {
            // decode json string
            $info = json_decode($listinginfo->listing_information);

            // get listing title
            $title = $listinginfo->listing_type == 'property' ? $info->property_name : $info->car_name;

            // edit breadcum
            UI::breadcrumb([$listingid => ucwords($title)]);

            // edit title
            UI::pageTitle('Edit '. ucwords($title));

            // export data
            dropbox('listinginfo', $listinginfo);

            // export images
            $images = json_decode($listinginfo->listing_images);
            $images = $images->images;

            foreach ($images as $index => $image)
            {
                $images[$index] = url($image);
            }

            dropbox('images', $images);

            $this->requirejs('php-vars.js');

            $this->modelAction('postEditProperty', function($response) use ($title)
            {
                if ($response)
                {
                    Alert::toastDefaultSuccess($title . ' updated successfully.');
                }
            });
        }
        else
        {
            $this->redir('listing');
        }

		$this->render('editproperty');
	}
	/**
    * @method Partner userRoles
    *
    * See documentation https://www.moorexa.com/doc/controller
    *
    * You can catch params sent through the $_GET request
    * @return void
    **/
     
	public function userRoles($action)
	{
        UI::pageTitle('User Roles');

        $view = 'userroles';
        $allowedActions = ['add' => 'Add User Role', 'edit' => 'Edit Role'];

        // get all account types under partnership
        $subAccounts = $this->query->getAllPartnerSubAccounts();

        // get all navigation for sub account
        $accountNavigation = [];

        $subAccounts->obj(function($row) use (&$accountNavigation)
        {
            // get navigation
            $nav = $row->from('accountNavigation', 'accountid')->get();

            // get nav list
            $navList = [];

            $nav->obj(function($sub) use (&$navList, $row){
                $navList[] = [
                    'id' => $sub->accountNavigationid,
                    'title' => $sub->page_title,
                    'link' => $sub->page_link
                ];
            });

            // move to account navigation
            $accountNavigation[$row->accountid] = $navList;
        });

        
        dropbox('navigation', json_encode($accountNavigation));
        $this->requirejs('php-vars.js');
        dropbox('subaccounts', $subAccounts);

        if (!is_null($action) && isset($allowedActions[$action]))
        {
            $view .= '/' . $action;
            UI::pageTitle($allowedActions[$action]);
        }
        
		$this->render($view);
	}
	/**
    * @method Partner propertyFloors
    *
    * See documentation https://www.moorexa.com/doc/controller
    *
    * You can catch params sent through the $_GET request
    * @return void
    **/

	public function propertyFloors($action)
	{
        $view = 'propertyfloors';
        UI::pageTitle('Property Floors');
        $allowedActions = ['add' => 'Add a Floor', 'edit' => 'Edit Floor'];

        if (!is_null($action) && isset($allowedActions[$action]))
        {
            $view .= '/' . $action;
            UI::pageTitle($allowedActions[$action]);
        }

		$this->render($view);
	}
}
// END class