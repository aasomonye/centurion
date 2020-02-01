<?php

use Moorexa\Structure as Schema;

class Mail_logger
{
    // connection identifier
    public $connectionIdentifier = '';


    // create table structure
    public function up(Schema $schema)
    {
        $schema->table = 'mail_logger';
        $schema->createStatement("
			loggerid             bigint  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
			userid               bigint,
			message              longtext,
			datesent             datetime   DEFAULT CURRENT_TIMESTAMP,
			CONSTRAINT unq_mail_logger_userid UNIQUE ( userid )
		");
         
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
        $option->rename('mail_logger'); // rename table
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