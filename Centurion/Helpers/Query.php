<?php
namespace Centurion\Helpers;

/**
 * @package Centurion queries
 * This would manage all the database queries for this application
 */
class Query
{
    public static function getLockByStatus(string $status)
    {
        return db('lock_status')->get('lock_status = ?')->bind($status);
    }

    public static function applyAuthenticationRecordForUser(array $record)
    {
        return db('authentication')->insert($record);
    }

    public static function applyActivationRecordForUser(array $record)
    {
        return db('activations')->insert($record);
    }

    public static function logMessageToDatabase(array $record)
    {
        return db('mail_logger')->insert($record);
    }

    public static function getUserByEmail(string $emailAddress)
    {
        return db('users')->get('email_address = ?', $emailAddress);
    }

    public static function getAuthenticationByUserId(int $userid)
    {
        return db('authentication')->get('userid = ?', $userid);
    }

    public static function getCustomerAccount()
    {
        return db('accounts')->get('account_name = ?', 'customer')->accountid;
    }

    public static function getAdminAccount()
    {
        return db('accounts')->get('account_name = ?', 'admin')->accountid;
    }

    public static function getPartnerAccount()
    {
        return db('accounts')->get('account_name = ?', 'partner')->accountid;
    }

    public static function applyLoginTrackForRegistration(array $record)
    {
        return db('login_tracker')->insert($record);
    }

    public static function getParentNavigation()
    {
        // get accountid
        $accountid = \Guards::user()->accountid;

        // get account navigation by accountid
        return db('accountNavigation')->get('accountid = ? and parentid = ?', $accountid, 0);
    }

    public static function getNavigation()
    {
        // get accountid
        $accountid = \Guards::user()->accountid;

        // get account navigation by accountid
        return db('accountNavigation')->get('accountid = ?', $accountid);
    }

    public static function getSubNavigation(int $accountNavigationid)
    {
        // get sub navigation
        return db('accountNavigation')->get('parentid = ?', $accountNavigationid);
    }

    // check if account has been activated
    public static function isActivated()
    {
        // get current user id
        $userid = \Guards::id();

        return (self::getAuthenticationByUserId($userid)->isactivated == 1 ? true : false);
    }

    // check user activation code received from the mail
    public static function checkActivationCode(string $activationCode)
    {
        $check = db('activations')->get('activation_code = ?', $activationCode);

        if ($check->rows > 0)
        {
            return $check;
        }

        return false;
    }

    // get admin users
    public function getAdminUsers()
    {
       return db('users')->get('accountid = ?', self::getAdminAccount());
    }

    // get general users
    public function getGeneralUsers()
    {
        return db('users')->get('accountid != ?', self::getAdminAccount());
    }

    // get all partners
    public function getAllPartners()
    {
        return db('business_information')->get()->orderby('verified', 'desc');
    }

    // 
    public function getBusinessInformation()
    {
        // business information
        return db('business_information')->get('userid = ?', \Guards::id());
    }

    // is user a customer or partner
    public static function isCustomerOrPartner()
    {
        // and the account id
        $accountid = \Guards::account()->accountid;

        // customerid
        $customerid = self::getCustomerAccount();
        $partnerid = self::getPartnerAccount();
        $passed = false;

        if ( ($customerid == $accountid) || ($partnerid == $accountid) )
        {
            $passed = true; 
        }

        return $passed;
    }

    // get account information
    public static function getAccountInformation(string $account_name)
    {
        return db('accounts')->get('account_name = ?', $account_name);
    }

    // check if url path exists
    public static function urlPathExists(string $urlpath)
    {
        $exists = false;
        $check = db('accountNavigation')->get('accountid = ? and page_link = ?', \Guards::account()->accountid, $urlpath);

        if ($check->rows > 0)
        {
            $exists = true;
        }

        return $exists;
    }

    // get property rule parent
    public function getPropertyRuleParent()
    {
        $parentRule = db('property_rules')->get('parentid = ?', 0);

        return $parentRule;
    }

    // property List Has Child
    public function propertyListHasChild(int $propertylistid)
    {
        $hasChild = db('property_rules')->get('parentid = ?', $propertylistid);
        $hasChildList = false;

        if ($hasChild->rows > 0)
        {
            $hasChildList = true;
        }

        return $hasChildList;
    }

    // get property value
    public function getPropertyListVal(int $propertylistid)
    {
        return db('property_rules')->get()->primary($propertylistid);
    }

    // get property rule children
    public function getPropertyRuleChildren(int $parentid)
    {
        return db('property_rules')->get('parentid = ?', $parentid);
    }

    // get all parent facilities
    public function getAllParentFacilities()
    {
        return db('property_facilities')->get('parentid = ?', 0)->orderbyprimarykey('desc');
    }

    // get all children facilities
    public function getAllChildrenFacilities(int $facilityid)
    {
        return db('property_facilities')->get('parentid = ?')->bind($facilityid);
    }

    // get all rooms facilities
    public function getAllRoomFacilities()
    {
        return db('property_facilities')->get('applytoroom = ?', 1);
    }

    // get all room rules
    public function getAllRoomRules()
    {
        return db('property_rules')->get('applytoroom = ?', 1);
    }

    // get all partner property listing
    public function getPartnerPropertyListing()
    {
        return db('partner_listing')->get('listing_type = ? and userid = ?', 'property', \Guards::id());
    }

    // get all partner property listing
    public function getAllPartnerPropertyListing()
    {
        return db('partner_listing')->get('listing_type = ?', 'property');
    }

    // get property type by id
    public function getPropertyTypeById(int $propertyid)
    {
        return db('property_types')->get('property_typeid = ?', $propertyid)->pick('propertytype');
    }

    // get listing bookings
    public function getListBookings(int $listingid)
    {
        return db('partner_bookings')->get('listingid = ?', $listingid);
    }

    // check if listing exists
    public function listingExists($listingid, &$listingInfo=null)
    {
        $doesExists = false;

        // convert to integer
        $listingid = intval($listingid);

        if (is_int($listingid) && $listingid > 0)
        {
            // check
            $listingInfo = db('partner_listing')->get('listingid = ?', $listingid);

            if ($listingInfo->rows > 0)
            {
                $doesExists = true;
            }
        }

        return $doesExists;
    }

    // check unverified listing
    public function unverifiedListingsForAdmin($listing_type = null)
    {
        return db('partner_listing')->get('approved = ?', 0)
        ->if(!is_null($listing_type), function($query) use ($listing_type)
        {
            $query->andWhere('listing_type = ?', $listing_type);
        });
    }

    // check unverified partners
    public function unverifiedPartners()
    {
        return db('business_information')->get('verified = ?', 0);
    }

    // get listing by id
    public function getListingById(int $listingid)
    {
        return db('partner_listing')->get('listingid = ?', $listingid);
    }

    // get other properties
    public static function getOtherPropertiesExcept(int $listingid, $listing_type = 'property')
    {
        return db('partner_listing')->get('listing_type = ? and userid = ? and listingid != ?')->bind($listing_type, \Guards::id(), $listingid)->rand();
    }

    // get facility by id
    public function getFacilityById(int $facilityid)
    {
        return db('property_facilities')->get()->primary($facilityid);
    }

    // get property rule
    public function getPropertyRule(int $ruleid)
    {
        return db('property_rules')->get()->primary($ruleid)->property_rule_title;
    }

    // 
    public function getPropertiesWithType(string $propertytypeid)
    {
        // get property listing
        static $listing;

        if ($listing === null || (is_array($listing) && !isset($listing[$propertytypeid])))
        {
            $getlisting = db('partner_listing')->get('listing_type = ? and approved = ?', 'property', 1);

            if ($getlisting->rows > 0)
            {
                $allListing = [];

                $getlisting->obj(function($row) use ($propertytypeid, &$allListing){
                    // get listing information
                    $jsondata = json_decode($row->listing_information);
                    if ($jsondata->property_type == $propertytypeid)
                    {
                        $allListing[] = $row;
                    }
                });

                $listing = is_null($listing) ? [] : $listing;

                $listing[$propertytypeid] = $allListing;
            }
        }

        return $listing[$propertytypeid];
    }

    public function getPropertiesFromListing()
    {
        return db('partner_listing')->get('listing_type = ? and approved = ?', 'property', 1);
    }
    
    // get all partner sub accounts
    public function getAllPartnerSubAccounts()
    {
        // get primary key of partner
        $partner = db('accounts')->get('account_name = ?', 'partner');
        return $partner->getparentid();
    }
}