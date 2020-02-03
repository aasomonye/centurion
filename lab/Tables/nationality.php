<?php

use Moorexa\Structure as Schema;

class Nationality
{
    // connection identifier
    public $connectionIdentifier = '';

    // create table structure
    public function up(Schema $schema)
    {
        $schema->table = 'nationality';
        $schema->createStatement("
			nationalityid        int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
			country_name         varchar(100),
			country_code         char(5)
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
        $option->rename('nationality'); // rename table
        $option->engine('innoDB'); // set table engine
        $option->collation('utf8_general_ci'); // set collation
    }

    // promise during migration
    public function promise($status, $table)
    {
        if ($status == 'complete')
        {
            // do some cool stuffs.
            // $this->table => for ORM operations to this table.
            $records = [
                ['country_name' => 'Nigerian', 'country_code' => 'NG'],
                ['country_name' => 'Ghanian',  'country_code' => 'GH'],
            ];

            foreach ($records as $record)
            {
                $table->insert($record);
            }
        }
    }
}