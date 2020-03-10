<?php

use Moorexa\Structure as Schema;

class Business_information
{
    // connection identifier
    public $connectionIdentifier = '';


    // create table structure
    public function up(Schema $schema)
    {
        $schema->increment('business_informationid');
        $schema->string('business_name');
        $schema->string('contact_phone');
        $schema->string('contact_email');
        $schema->string('contact_address', 300);
        $schema->string('cac_certificate', 300);
        $schema->bigint('userid');
        $schema->text('about_business');
        $schema->tinyint('verified')->default(0);
        $schema->string('tin_number');
        // and more.. 
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
        $option->rename('business_information'); // rename table
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