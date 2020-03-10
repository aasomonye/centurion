<?php

use Moorexa\Structure as Schema;

class Property_types
{
    // connection identifier
    public $connectionIdentifier = '';


    // create table structure
    public function up(Schema $schema)
    {
        $schema->increment('property_typeid');
        $schema->string('propertytype');
        $schema->string('typeicon');
        $schema->string('property_type_image');
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
        $option->rename('property_types'); // rename table
        $option->engine('innoDB'); // set table engine
        $option->collation('utf8_general_ci'); // set collation
    }

    // promise during migration
    public function promise($status)
    {
        if ($status == 'complete')
        {
            $propertytypes = [
                [
                    'propertytype' => 'Hotels',
                    'typeicon' => 'fa-hotel',
                    'property_type_image' => ''
                ],

                [
                    'propertytype' => 'Apartments',
                    'typeicon' => 'fa-houzz',
                    'property_type_image' => ''
                ],

                [
                    'propertytype' => 'Guest House',
                    'typeicon' => 'fa-person-booth',
                    'property_type_image' => ''
                ],

                [
                    'propertytype' => 'Short stay',
                    'typeicon' => 'fa-couchs',
                    'property_type_image' => ''
                ],

                [
                    'propertytype' => 'Bread & Breakfast',
                    'typeicon' => 'fa-couchs',
                    'property_type_image' => ''
                ]
            ];

            foreach ($propertytypes as $type)
            {
                $this->table->insert($type)->go();
            }
        }
    }
}