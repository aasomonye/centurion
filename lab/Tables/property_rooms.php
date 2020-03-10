<?php

use Moorexa\Structure as Schema;

class Property_rooms
{
    // connection identifier
    public $connectionIdentifier = '';


    // create table structure
    public function up(Schema $schema)
    {
        $schema->increment('property_roomid');
        $schema->bigint('propertylistingid');
        $schema->string('property_room_title');
        $schema->int('sleeps')->default(2);
        $schema->text('property_room_info');
        $schema->float('room_price');
        $schema->tinyint('isavaliable');
        $schema->int('total_rooms')->default(1);
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
        $option->rename('property_rooms'); // rename table
        $option->engine('innoDB'); // set table engine
        $option->collation('utf8_general_ci'); // set collation
    }

    // promise during migration
    public function promise($status)
    {
        if ($status == 'complete')
        {
            // do some cool stuffs.
            // $this->table => for ORM operations to this table.
        }
    }
}