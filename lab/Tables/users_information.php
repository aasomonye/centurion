<?php

use Moorexa\Structure as Schema;

class Users_information
{
    // connection identifier
    public $connectionIdentifier = '';


    // create table structure
    public function up(Schema $schema)
    {
        $schema->table = 'users_information';
        $schema->createStatement("
			informationid        bigint  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
			userid               bigint,
			telephone            varchar(100),
			home_address         varchar(200),
			work_address         varchar(200),
			account_name         varchar(150),
			account_number       varchar(100),
			bank_name            varchar(100),
			bank_swift_code      varchar(100)
		");
        $schema->alterStatement("COMMENT 'This would contain additional information for user'");
		$schema->alterStatement("MODIFY bank_name varchar(100)     COMMENT 'This would be added from banks table. We made this a text type so we can get add the name if not found in the list of banks by the user'");
		$schema->alterStatement("MODIFY bank_swift_code varchar(100)     COMMENT 'optional for user. But important to add for users outside nigeria'");
		$schema->alterStatement("ADD CONSTRAINT fk_users_information_users FOREIGN KEY ( userid ) REFERENCES users( userid ) ON DELETE NO ACTION ON UPDATE NO ACTION"); 
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
        $option->rename('users_information'); // rename table
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