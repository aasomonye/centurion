<?php

use Moorexa\Structure as Schema;

class Login_tracker
{
    // connection identifier
    public $connectionIdentifier = '';


    // create table structure
    public function up(Schema $schema)
    {
        $schema->table = 'login_tracker';
        $schema->createStatement("
			trackerid            int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
			authenticationid     bigint,
			last_login           varchar(100),
			date_registered      datetime   DEFAULT CURRENT_TIMESTAMP,
			isloggedin           tinyint   DEFAULT 0
		");
        $schema->alterStatement("COMMENT 'Login tracker for authenticated users.'");
		$schema->alterStatement("MODIFY last_login varchar(100)     COMMENT 'The last time this user loggedin'");
		$schema->alterStatement("MODIFY isloggedin tinyint   DEFAULT 0  COMMENT '1 = yes, 0 = no'");
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
        $option->rename('login_tracker'); // rename table
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