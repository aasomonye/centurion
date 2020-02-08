<?php

use Moorexa\Structure as Schema;

class Users
{
    // connection identifier
    public $connectionIdentifier = '';


    // create table structure
    public function up(Schema $schema)
    {
        $schema->table = 'users';
        $schema->createStatement("
			userid               bigint  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
			firstname            varchar(100),
			lastname             varchar(100),
			email_address        varchar(200),
            nationalityid        int,
            accountid            int
		");
        $schema->alterStatement("COMMENT 'users basic information provided during registration'"); 
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
        $option->rename('users'); // rename table
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