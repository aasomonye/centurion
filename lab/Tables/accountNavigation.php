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
        return db('accounts')->get('account_name = ?', $account_name)->accountid;
    }

    public function getparentid(string $page_title, $account_name = null)
    {
        $getPageTitle = db('accountNavigation');

        // get page title
        if ($account_name == null)
        {
            $getPageTitle = $getPageTitle->get('page_title = ?', $page_title);
        }
        else
        {
            $getPageTitle = $getPageTitle->get('page_title = ? and accountid = ?', $page_title, $this->accountId($account_name));
        }
        
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
            
            // admin nav
            $adminNav = [
                [
                    'page_title' => 'Dashbord',
                    'page_link' => 'admin/dashboard',
                    'page_icon' => 'nav-icon fas fa-tachometer-alt',
                    'accountid' => $this->accountId('admin')
                ],
                [
                    'page_title' => 'Partners',
                    'page_link' => 'admin/partners',
                    'page_icon' => 'nav-icon fas fa-users',
                    'accountid' => $this->accountId('admin')
                ],
                [
                    'page_title' => 'Administrators',
                    'page_link' => 'admin/users',
                    'page_icon' => 'nav-icon fas fa-cogs',
                    'accountid' => $this->accountId('admin')
                ],
                [
                    'page_title' => 'Listing',
                    'page_link' => 'admin/listing',
                    'page_icon' => 'nav-icon fas fa-city',
                    'accountid' => $this->accountId('admin')
                ],

                [
                    'page_title' => 'Property',
                    'page_link' => 'admin/listing/property',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('admin'),
                    'parentid' => function(){ return $this->getparentid('Listing', 'admin'); }
                ],

                [
                    'page_title' => 'Cars',
                    'page_link' => 'admin/listing/cars',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('admin'),
                    'parentid' => function(){ return $this->getparentid('Listing', 'admin'); }
                ],
            ];

            // partner nav
            $partnerNav = [
                [
                    'page_title' => 'Dashboard',
                    'page_link' => 'partner/dashboard',
                    'page_icon' => 'nav-icon fas fa-tachometer-alt',
                    'accountid' => $this->accountId('partner')
                ],

                [
                    'page_title' => 'Booked Rooms',
                    'page_link' => 'partner/dashboard/booked-rooms',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Dashboard', 'partner'); }
                ],

                [
                    'page_title' => 'Check In',
                    'page_link' => 'partner/dashboard/check-in',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Dashboard', 'partner'); }
                ],

                [
                    'page_title' => 'Check Out',
                    'page_link' => 'partner/dashboard/check-out',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Dashboard', 'partner'); }
                ],

                [
                    'page_title' => 'Guests in house',
                    'page_link' => 'partner/dashboard/guest-in-house',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Dashboard', 'partner'); }
                ],

                [
                    'page_title' => 'Expenditure',
                    'page_link' => 'partner/dashboard/expenditure',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Dashboard', 'partner'); }
                ],

                [
                    'page_title' => 'Revenue',
                    'page_link' => 'partner/dashboard/revenue',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Dashboard', 'partner'); }
                ],

                [
                    'page_title' => 'Listing',
                    'page_link' => 'partner/listing',
                    'page_icon' => 'nav-icon fas fa-city',
                    'accountid' => $this->accountId('partner')
                ],

                [
                    'page_title' => 'Rate & Avaliability',
                    'page_link' => 'partner/rate-avaliability',
                    'page_icon' => 'nav-icon fas fa-calendar',
                    'accountid' => $this->accountId('partner')
                ],

                [
                    'page_title' => 'Property',
                    'page_link' => 'partner/listing/property',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Listing', 'partner'); }
                ],

                [
                    'page_title' => 'Cars',
                    'page_link' => 'partner/listing/cars',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Listing', 'partner'); }
                ],

                [
                    'page_title' => 'Open/Close Rooms',
                    'page_link' => 'partner/rate-avaliability/open-close-rooms',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Rate & Avaliability', 'partner'); }
                ],

                [
                    'page_title' => 'Rate Plans',
                    'page_link' => 'partner/rate-avaliability/rate-plans',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Rate & Avaliability', 'partner'); }
                ],

                [
                    'page_title' => 'Adjust Rooms to sell',
                    'page_link' => 'partner/rate-avaliability/adjust-rooms-to-sell',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Rate & Avaliability', 'partner'); }
                ],

                [
                    'page_title' => 'Calender',
                    'page_link' => 'partner/rate-avaliability/calender',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Rate & Avaliability', 'partner'); }
                ],

                [
                    'page_title' => 'Rate Adjustment',
                    'page_link' => 'partner/rate-adjustment',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Rate & Avaliability', 'partner'); }
                ],

                [
                    'page_title' => 'Taxes',
                    'page_link' => 'partner/taxes',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Rate & Avaliability', 'partner'); }
                ],

                [
                    'page_title' => 'Fees',
                    'page_link' => 'partner/fees',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Rate & Avaliability', 'partner'); }
                ],

                [
                    'page_title' => 'Guests',
                    'page_link' => 'partner/guests',
                    'page_icon' => 'nav-icon fa fa-users',
                    'accountid' => $this->accountId('partner')
                ],

                [
                    'page_title' => 'Requests',
                    'page_link' => 'partner/guest-request',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Guests', 'partner'); }
                ],

                [
                    'page_title' => 'Messaging',
                    'page_link' => 'partner/guest-messaging',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Guests', 'partner'); }
                ],

                [
                    'page_title' => 'Refund',
                    'page_link' => 'partner/guest-refund',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Guests', 'partner'); }
                ],

                [
                    'page_title' => 'Add Guest',
                    'page_link' => 'partner/add-guest',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Guests', 'partner'); }
                ],

                [
                    'page_title' => 'Guests',
                    'page_link' => 'partner/guests',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Guests', 'partner'); }
                ],

                [
                    'page_title' => 'Settings',
                    'page_link' => 'partner/settings',
                    'page_icon' => 'nav-icon fa fa-cogs',
                    'accountid' => $this->accountId('partner')
                ],

                [
                    'page_title' => 'Human Resource',
                    'page_link' => 'partner/hr-center',
                    'page_icon' => 'nav-icon fa fa-male',
                    'accountid' => $this->accountId('partner')
                ],

                [
                    'page_title' => 'Employees',
                    'page_link' => 'partner/employees',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Human Resource', 'partner'); }
                ],

                [
                    'page_title' => 'Employees Account',
                    'page_link' => 'partner/employee-account',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Human Resource', 'partner'); }
                ],

                [
                    'page_title' => 'Departments',
                    'page_link' => 'partner/departments',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Human Resource', 'partner'); }
                ],

                [
                    'page_title' => 'Room Types',
                    'page_link' => 'partner/room-types',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Settings', 'partner'); }
                ],

                [
                    'page_title' => 'Hall Types',
                    'page_link' => 'partner/hall-types',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Settings', 'partner'); }
                ],

                [
                    'page_title' => 'Halls',
                    'page_link' => 'partner/halls',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Settings', 'partner'); }
                ],

                [
                    'page_title' => 'Price Manager',
                    'page_link' => 'partner/price-manager',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Settings', 'partner'); }
                ],

                [
                    'page_title' => 'Paid Services',
                    'page_link' => 'partner/paid-services',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Settings', 'partner'); }
                ],

                [
                    'page_title' => 'Property Floors',
                    'page_link' => 'partner/property-floors',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Settings', 'partner'); }
                ],

                [
                    'page_title' => 'Room Types',
                    'page_link' => 'partner/room-types',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Settings', 'partner'); }
                ],

                [
                    'page_title' => 'User Roles',
                    'page_link' => 'partner/user-roles',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Settings', 'partner'); }
                ],

                [
                    'page_title' => 'Tax Management',
                    'page_link' => 'partner/tax-management',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Settings', 'partner'); }
                ],

                [
                    'page_title' => 'Coupons',
                    'page_link' => 'partner/coupon-management',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Settings', 'partner'); }
                ],

                [
                    'page_title' => 'Services',
                    'page_link' => 'partner/services',
                    'page_icon' => 'far fa-circle nav-icon',
                    'accountid' => $this->accountId('partner'),
                    'parentid' => function(){ return $this->getparentid('Settings', 'partner'); }
                ],

                
            ];

            // housekeeper nav
            $housekeeperNav = [
                [
                    'page_title' => 'Dashboard',
                    'page_link' => 'housekeeper/dashboard',
                    'page_icon' => 'nav-icon fas fa-tachometer-alt',
                    'accountid' => $this->accountId('housekeeper')
                ],

                [
                    'page_title' => 'Tasks',
                    'page_link' => 'housekeeper/tasks',
                    'page_icon' => 'nav-icon fas fa-task',
                    'accountid' => $this->accountId('housekeeper')
                ],

                [
                    'page_title' => 'Guest Requests',
                    'page_link' => 'housekeeper/guest-requests',
                    'page_icon' => 'nav-icon fas fa-task',
                    'accountid' => $this->accountId('housekeeper')
                ],

                [
                    'page_title' => 'Reports',
                    'page_link' => 'housekeeper/reports',
                    'page_icon' => 'nav-icon fas fa-chart-line',
                    'accountid' => $this->accountId('housekeeper')
                ],
            ];

            // front desk nav
            $frontdeskNav = [
                [
                    'page_title' => 'Dashboard',
                    'page_link' => 'frontDesk/dashboard',
                    'page_icon' => 'nav-icon fas fa-tachometer-alt',
                    'accountid' => $this->accountId('front desk')
                ],

                [
                    'page_title' => 'Reservations',
                    'page_link' => 'frontDesk/reservations',
                    'page_icon' => 'nav-icon fas fa-calendar',
                    'accountid' => $this->accountId('front desk')
                ],

                [
                    'page_title' => 'Bookings',
                    'page_link' => 'frontDesk/bookings',
                    'page_icon' => 'nav-icon fas fa-book',
                    'accountid' => $this->accountId('front desk')
                ],

                [
                    'page_title' => 'Guest Requests',
                    'page_link' => 'frontDesk/guest-requests',
                    'page_icon' => 'nav-icon fa fa-user',
                    'accountid' => $this->accountId('front desk')
                ],

                [
                    'page_title' => 'Guests',
                    'page_link' => 'frontDesk/guests',
                    'page_icon' => 'nav-icon fa fa-users',
                    'accountid' => $this->accountId('front desk')
                ],

                [
                    'page_title' => 'Rooms',
                    'page_link' => 'frontDesk/rooms',
                    'page_icon' => 'nav-icon fa fa-door-opened',
                    'accountid' => $this->accountId('front desk')
                ],
            ];

            $records = array_merge($records, $adminNav, $housekeeperNav, $frontdeskNav, $partnerNav);

            // run insert query
            foreach ($records as $record)
            {
                $this->table->insert($record)->go();
            }
        }
    }
}