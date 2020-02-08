<?php

use Moorexa\Structure as Schema;

class Activations
{
    // connection identifier
    public $connectionIdentifier = '';


    // create table structure
    public function up(Schema $schema)
    {
        $schema->table = 'activations';
        $schema->createStatement("
			activationid         bigint  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
			userid               bigint,
			activation_code      varchar(100),
			redirect_to          varchar(100),
			satisfied            int   DEFAULT 0,
			lockid               int
		");
        $schema->alterStatement("COMMENT 'This would contain all activation triggered or required for a user.'");
		$schema->alterStatement("MODIFY satisfied int   DEFAULT 0  COMMENT 'This operation, has it been satisfied ? 1 = yes, 0 = no.'");
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
        $option->rename('activations'); // rename table
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