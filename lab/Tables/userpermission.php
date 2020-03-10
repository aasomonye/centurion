<?php

use Moorexa\Structure as Schema;

class Userpermission
{
    // connection identifier
    public $connectionIdentifier = '';


    // create table structure
    public function up(Schema $schema)
    {
        $schema->increment('userpermissionid');
        $schema->string('userpermission');
        $schema->string('permission_info');
        $schema->text('executable_instruction');
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
        $option->rename('userpermission'); // rename table
        $option->engine('innoDB'); // set table engine
        $option->collation('utf8_general_ci'); // set collation
    }

    public function serializeFunc(closure $function)
    {
        $class = new \Opis\Closure\SerializableClosure($function);
        return serialize($class);
    }

    // promise during migration
    public function promise($status)
    {
        if ($status == 'complete')
        {
            $permissions = [
                [
                    'userpermission' => 'read',
                    'permission_info' => 'User has read rights',
                    'executable_instruction' => $this->serializeFunc(function($userid){
                        // check roles to be sure user has this permission
                        $check = db('userroles')->get('userid = ? and can_read = ?', $userid, 1);
                        return $check->rows > 0 ? true : false;
                    })
                ],

                [
                    'userpermission' => 'write',
                    'permission_info' => 'User has write rights',
                    'executable_instruction' => $this->serializeFunc(function($userid){
                        // check roles to be sure user has this permission
                        $check = db('userroles')->get('userid = ? and can_write = ?', $userid, 1);
                        return $check->rows > 0 ? true : false;
                    })
                ],

                [
                    'userpermission' => 'update',
                    'permission_info' => 'User has update rights',
                    'executable_instruction' => $this->serializeFunc(function($userid){
                        // check roles to be sure user has this permission
                        $check = db('userroles')->get('userid = ? and can_update = ?', $userid, 1);
                        return $check->rows > 0 ? true : false;
                    })
                ],

                [
                    'userpermission' => 'delete',
                    'permission_info' => 'User has delete rights',
                    'executable_instruction' => $this->serializeFunc(function($userid){
                        // check roles to be sure user has this permission
                        $check = db('userroles')->get('userid = ? and can_delete = ?', $userid, 1);
                        return $check->rows > 0 ? true : false;
                    })
                ],
            ];

            // insert
            foreach ($permissions as $permission)
            {
                $this->table->insert($permission)->go();
            }
        }
    }
}