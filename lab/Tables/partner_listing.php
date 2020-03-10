<?php

use Moorexa\Structure as Schema;

class Partner_listing
{
    // connection identifier
    public $connectionIdentifier = '';


    // create table structure
    public function up(Schema $schema)
    {
        $schema->increment('listingid');
        $schema->string('listing_type')->default('property');
        $schema->longtext('listing_information');
        $schema->longtext('listing_images');
        $schema->longtext('room_images');
        $schema->bigint('userid');
        $schema->datetime('dateadded')->current();
        $schema->tinyint('approved')->default(0);
        $schema->text('action_note');
        $schema->string('cover_image');
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
        $option->rename('partner_listing'); // rename table
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