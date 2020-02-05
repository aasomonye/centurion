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
    public function promise($status, $table)
    {
        if ($status == 'complete')
        {
            // do some cool stuffs.
            // $this->table => for ORM operations to this table.
            $status = [
                [
                 'lock_status' => 'blocked',
                 'lock_note' => 'Account was blocked by the system',
                 'lock_screen_link' => 'app/contact'
                ],
                [
                 'lock_status' => 'password reset',
                 'lock_note' => 'Account was locked due to password reset',
                 'lock_screen_link' => 'app/activate'
                ],
                [
                 'lock_status' => 'profile update',
                 'lock_note' => 'Account was locked due to profile update',
                 'lock_screen_link' => 'app'
                ],
                [
                 'lock_status' => 'new account',
                 'lock_note' => 'Account was locked due to verification',
                 'lock_screen_link' => 'dashboard' 
                ]
            ];

            // add data
            foreach ($status as $data)
            {
                $table->insert($data);
            }
        }
    }
}