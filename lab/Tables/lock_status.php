<?php

use Moorexa\Structure as Schema;

class Lock_status
{
    // connection identifier
    public $connectionIdentifier = '';


    // create table structure
    public function up(Schema $schema)
    {
        $schema->table = 'lock_status';
        $schema->createStatement("
			lockid               int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
			lock_status          varchar(100),
			lock_note            text,
			lock_screen_link     varchar(100)
		");
        $schema->alterStatement("COMMENT 'All lock status and their code. 1 = blocked, 2 = password reset, 3 = profile update'");
		$schema->alterStatement("MODIFY lock_note text     COMMENT 'Lock state note. if user appears to be here what should be the message sent.'");
		$schema->alterStatement("MODIFY lock_screen_link varchar(100)     COMMENT 'Link for redirection before returning to the dashboard or previous page'");
		$schema->alterStatement("ADD CONSTRAINT fk_lock_status_authentication FOREIGN KEY ( lockid ) REFERENCES authentication( lockid ) ON DELETE NO ACTION ON UPDATE NO ACTION"); 
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
        $option->rename('lock_status'); // rename table
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