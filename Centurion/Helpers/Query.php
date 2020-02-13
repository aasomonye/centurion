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

    public static function getSubNavigation(int $accountNavigationid)
    {
        // get sub navigation
        return db('accountNavigation')->get('parentid = ?', $accountNavigationid);
    }

}