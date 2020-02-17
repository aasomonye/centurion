<?php

use Moorexa\Structure as Schema;

class AccountNavigation
{
    // connection identifier
    public $connectionIdentifier = '';


    // create table structure
    public function up(Schema $schema)
    {
        $schema->increment('accountNavigationid');
        $schema->int('accountid');
        $schema->string('page_title');
        $schema->string('page_link');
        $schema->int('parentid')->default(0);
        $schema->string('page_icon');
        $schema->tinyint('visible')->default(1);
    }

    // drop table
    public function down($drop, $record)
    {
        // $record carries table rows if exists.
        // execute drop table command
        $drop();
    }

    // options
    public function option($option)
    {
        $option->rename('accountNavigation'); // rename table
        $option->engine('innoDB'); // set table engine
        $option->collation('utf8_general_ci'); // set collation
    }

    // get account id
    public function queryGetid($query, string $account_name)
    {
       $query->get('account_name = ?', $account_name);
    }

    public function accountId(string $account_name)
    {
        static $account;

        if ($account == null)
        {
            $account = db('accounts');
        }

        return $account->query('Getid', $account_name)->accountid;
    }

    public function getparentid(string $page_title)
    {
        // get page title
        $getPageTitle = db('accountNavigation')->get('page_title = ?', $page_title);
        return $getPageTitle->accountNavigationid;
    }

    // promise during migration
    public function promise($status, $table)
    {
        if ($status == 'complete')
        {
            // insert table record
            $records = [
                [
                    'page_title' => 'Dashboard',
                    'page_link' => 'customer/dashboard',
                    'page_icon' => 'nav-icon fas fa-tachometer-alt',
                    'accountid' => $this->accountId('customer')
                ],

                [
                    'page_title' => 'Deals',
                    'page_link' => 'customer/deals',
                    'page_icon' => 'nav-icon fas fa-grin-stars',
                    'accountid' => $this->accountId('customer')
                ],

                [
                    'page_title' => 'Booking',
                    'page_link' => 'customer/booking',
                    'page_icon' => 'nav-icon fas fa-book',
                    'accountid' => $this->accountId('customer')
                ],

                [
                    'page_title' => 'History',
                    'page_link' => 'customer/booking/history',
                    'page_icon' => 'far fa-circle nav-icon',
                    'parentid' => function(){ return $this->getparentid('Booking'); },
                    'accountid' => $this->accountId('customer')
                ],

                [
                    'page_title' => 'Create',
                    'page_link' => 'customer/booking/create',
                    'page_icon' => 'far fa-circle nav-icon',
                    'parentid' => function(){ return $this->getparentid('Booking'); },
                    'accountid' => $this->accountId('customer')
                ],

                [
                    'page_title' => 'Rental',
                    'page_link' => 'customer/rental',
                    'page_icon' => 'nav-icon fas fa-car',
                    'accountid' => $this->accountId('customer')
                ],

                [
                    'page_title' => 'History',
                    'page_link' => 'customer/rental/history',
                    'page_icon' => 'far fa-circle nav-icon',
                    'parentid' => function(){ return $this->getparentid('Rental'); },
                    'accountid' => $this->accountId('customer')
                ],

                [
                    'page_title' => 'Create',
                    'page_link' => 'customer/rental/create',
                    'page_icon' => 'far fa-circle nav-icon',
                    'parentid' => function(){ return $this->getparentid('Rental'); },
                    'accountid' => $this->accountId('customer')
                ],

                [
                    'page_title' => 'Support',
                    'page_link' => 'customer/support',
                    'page_icon' => 'nav-icon far fa-question-circle',
                    'accountid' => $this->accountId('customer')
                ],

                [
                    'page_title' => 'Testimonial',
                    'page_link' => 'customer/support/testimonial',
                    'page_icon' => 'far fa-circle nav-icon',
                    'parentid' => function(){ return $this->getparentid('Support'); },
                    'accountid' => $this->accountId('customer')
                ],

                [
                    'page_title' => 'Ticket',
                    'page_link' => 'customer/support/ticket',
                    'page_icon' => 'far fa-circle nav-icon',
                    'parentid' => function(){ return $this->getparentid('Support'); },
                    'accountid' => $this->accountId('customer')
                ],

                [
                    'page_title' => 'Reports',
                    'page_link' => 'customer/report',
                    'page_icon' => 'nav-icon fas fa-table',
                    'accountid' => $this->accountId('customer')
                ],

                [
                    'page_title' => 'Orders',
                    'page_link' => 'customer/report/orders',
                    'page_icon' => 'far fa-circle nav-icon',
                    'parentid' => function(){ return $this->getparentid('Reports'); },
                    'accountid' => $this->accountId('customer')
                ],

                [
                    'page_title' => 'Checking History',
                    'page_link' => 'customer/report/checking-history',
                    'page_icon' => 'far fa-circle nav-icon',
                    'parentid' => function(){ return $this->getparentid('Reports'); },
                    'accountid' => $this->accountId('customer')
                ],

                [
                    'page_title' => 'Transactions',
                    'page_link' => 'customer/report/transactions',
                    'page_icon' => 'far fa-circle nav-icon',
                    'parentid' => function(){ return $this->getparentid('Reports'); },
                    'accountid' => $this->accountId('customer')
                ],

                [
                    'page_title' => 'Profile',
                    'page_link' => 'dashboard/profile',
                    'page_icon' => 'nav-icon fas fa-user',
                    'accountid' => $this->accountId('customer')
                ],

                [
                    'page_title' => 'Membership',
                    'page_link' => 'customer/membership',
                    'page_icon' => 'nav-icon fas fa-crown',
                    'accountid' => $this->accountId('customer')
                ],

                [
                    'page_title' => 'Coupons',
                    'page_link' => 'customer/coupon',
                    'page_icon' => 'nav-icon fas fa-tag',
                    'accountid' => $this->accountId('customer')
                ],
            ];

            // run insert query
            foreach ($records as $record)
            {
                $table->insert($record);
            }
        }
    }
}