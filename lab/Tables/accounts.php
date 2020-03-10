<?php

use Moorexa\Structure as Schema;

class Accounts
{
    // connection identifier
    public $connectionIdentifier = '';


    // create table structure
    public function up(Schema $schema)
    {
        $schema->table = 'accounts';
        $schema->createStatement("
			accountid            int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
			account_name         varchar(100),
            account_base_url     varchar(100)   DEFAULT 'dashboard',
            parentid             int null
		");
        $schema->alterStatement("COMMENT 'This has the record of all the account types. 1 = customer, 2 = admin, 3 = partner'");
		$schema->alterStatement("MODIFY account_base_url varchar(100)   DEFAULT 'dashboard'  COMMENT 'Base url for this account. default should be dashboard.'"); 
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
        $option->rename('accounts'); // rename table
        $option->engine('innoDB'); // set table engine
        $option->collation('utf8_general_ci'); // set collation
    }

    // get parentid
    public function getparentid(string $account_name)
    {
        return db(self::class)->get('account_name = ?', $account_name)->pick('accountid');
    }

    // promise during migration
    public function promise($status, $table)
    {
        if ($status == 'complete')
        {
            $records = [
                ['account_name' => 'customer', 'account_base_url' => 'customer/dashboard'],
                ['account_name' => 'admin', 'account_base_url' => 'admin/dashboard'],
                ['account_name' => 'partner', 'account_base_url' => 'partner/dashboard'],
                ['account_name' => 'prenium', 'account_base_url' => 'customer/dashboard'],
                [  
                    'account_name' => 'housekeeper',
                    'account_base_url' => 'housekeeper/dashboard',
                    'parentid' => function(){ return $this->getparentid('partner'); }
                ],
                [  
                    'account_name' => 'front desk',
                    'account_base_url' => 'frontdesk/dashboard',
                    'parentid' => function(){ return $this->getparentid('partner'); }
                ],
                [  
                    'account_name' => 'resident manager',
                    'account_base_url' => 'manager/dashboard',
                    'parentid' => function(){ return $this->getparentid('partner'); }
                ],
                [  
                    'account_name' => 'auditor',
                    'account_base_url' => 'auditor/dashboard',
                    'parentid' => function(){ return $this->getparentid('partner'); }
                ],
                [  
                    'account_name' => 'accountant',
                    'account_base_url' => 'accountant/dashboard',
                    'parentid' => function(){ return $this->getparentid('partner'); }
                ],
            ];

            foreach ($records as $record)
            {
                $table->insert($record)->go();
            }
        }
    }
}