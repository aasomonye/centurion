<?php

use Moorexa\Structure as Schema;

class Userroles
{
    // connection identifier
    public $connectionIdentifier = '';


    // create table structure
    public function up(Schema $schema)
    {
        $schema->increment('userroleid');
        $schema->bigint('userid')->comment('User ID of role creator. Should be partner id');
        $schema->string('userrole');
        $schema->int('can_read')->default(1);
        $schema->int('can_write')->default(0);
        $schema->int('can_update')->default(0);
        $schema->int('can_delete')->default(0);
        $schema->longtext('navigation_config');
        $schema->int('accountid')->default(0);
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
        $option->rename('userroles'); // rename table
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