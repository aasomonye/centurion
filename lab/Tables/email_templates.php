<?php

use Moorexa\Structure as Schema;

class Email_templates
{
    // connection identifier
    public $connectionIdentifier = '';


    // create table structure
    public function up(Schema $schema)
    {
        $schema->table = 'email_templates';
        $schema->createStatement("
			emailtemplateid      int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
			lockid               int,
			template_name        varchar(100),
			template_body        longtext
		");
        $schema->alterStatement("COMMENT 'email templates for all lock status'");
		$schema->alterStatement("MODIFY template_name varchar(100)     COMMENT 'name of this template. so we can have options'");   
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
        $option->rename('email_templates'); // rename table
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