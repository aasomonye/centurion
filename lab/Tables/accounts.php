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
			account_base_url     varchar(100)   DEFAULT 'dashboard'
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

    // promise during migration
    public function promise($status)
    {
        if ($status == 'waiting' || $status == 'complete')
        {
            // do some cool stuffs.
            // $this->table => for ORM operations to this table.
        }
    }
}