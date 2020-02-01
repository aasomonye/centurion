<?php

use Moorexa\Structure as Schema;

class Authentication
{
    // connection identifier
    public $connectionIdentifier = '';


    // create table structure
    public function up(Schema $schema)
    {
        $schema->table = 'authentication';
        $schema->createStatement("
			authenticationid     bigint  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
			userid               bigint,
			password_salt        varchar(150),
			password_hash        text,
			session_token        varchar(100),
			remember_me_cookie   text,
			isactivated          int   DEFAULT 0,
			lockid               int,
			CONSTRAINT unq_authentication_lockid UNIQUE ( lockid ),
			CONSTRAINT unq_authentication_userid UNIQUE ( userid )
		");
        $schema->alterStatement("COMMENT 'Authentication table for user'");
		$schema->alterStatement("MODIFY userid bigint     COMMENT 'user id from users table'");
		$schema->alterStatement("MODIFY password_salt varchar(150)     COMMENT 'password salt for password hashing'");
		$schema->alterStatement("MODIFY session_token varchar(100)     COMMENT 'Token given upon login'");
		$schema->alterStatement("MODIFY remember_me_cookie text     COMMENT 'Cookie data for remember me'");
		$schema->alterStatement("MODIFY isactivated int   DEFAULT 0  COMMENT 'is user verified and activated ? 0 = no, 1 = yes'");
		$schema->alterStatement("MODIFY lockid int     COMMENT 'lock state. 0 = none'"); 
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
        $option->rename('authentication'); // rename table
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