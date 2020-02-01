<?php

use Moorexa\Structure as Schema;

class Navigation
{
    // connection identifier
    public $connectionIdentifier = '';


    // create table structure
    public function up(Schema $schema)
    {
        $schema->table = 'navigation';
        $schema->createStatement("
			navigationid         int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
			account_group        longtext,
			navigation_name      varchar(100),
			navigation_link      varchar(100),
			navigation_icon      varchar(100),
			position             int   DEFAULT 1,
			visible              int   DEFAULT 1
		");
        $schema->alterStatement("COMMENT 'navigation table for all account types'");
		$schema->alterStatement("MODIFY account_group longtext COMMENT 'should be seperated with a comma. eg. 1,2. means that this link would be accessible to this account group. This id would be linked to the accounts table.'");
		$schema->alterStatement("MODIFY navigation_icon varchar(100)     COMMENT 'entirely optional. Just in case we introduce icons to the link from the frontend'");
		$schema->alterStatement("MODIFY position int   DEFAULT 1  COMMENT 'placement for this navigation link'");
		$schema->alterStatement("MODIFY visible int   DEFAULT 1  COMMENT 'should link be visible. 1 = yes, 0 = no'"); 
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
        $option->rename('navigation'); // rename table
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