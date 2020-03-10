<?php

use Moorexa\Structure as Schema;

class Property_facilities
{
    // connection identifier
    public $connectionIdentifier = '';


    // create table structure
    public function up(Schema $schema)
    {
        $schema->increment('property_facilityid');
        $schema->string('facility');
        $schema->string('facility_icon');
        $schema->tinyint('visible')->default(1);
        $schema->int('parentid')->default(0);
        $schema->tinyint('applytoroom')->default(0);
        $schema->string('input_type')->default('checkbox');
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
        $option->rename('property_facilities'); // rename table
        $option->engine('innoDB'); // set table engine
        $option->collation('utf8_general_ci'); // set collation
    }

    // get parent id
    public function parentid(string $facility)
    {
        return db(self::class)->get('facility = ?', $facility)->property_facilityid;
    }

    // promise during migration
    public function promise($status)
    {
        if ($status == 'complete')
        {
            // add facilitiws
            $facilities = [
                [
                    'facility' => 'Free parking',
                    'facility_icon' => 'fa-parking',
                ],

                [
                    'facility' => 'Free wifi',
                    'facility_icon' => 'fa-broadcast-tower',
                ],

                [
                    'facility' => 'Food & drink',
                    'facility_icon' => 'fa-pizza-slice',
                ],

                [
                    'facility' => 'car rental',
                    'facility_icon' => 'fa-car-alt',
                ],

                [
                    'facility' => 'Outdoors',
                    'facility_icon' => 'fa-theater-masks',
                ],

                [
                    'facility' => 'outdoor furniture',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('Outdoors'); }
                ],

                [
                    'facility' => 'Garden',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('Outdoors'); }
                ],

                [
                    'facility' => 'Swimming Pool',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('Outdoors'); }
                ],

                [
                    'facility' => 'Outdoor Bar',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('Outdoors'); }
                ],
                
                [
                    'facility' => 'pets',
                    'facility_icon' => 'fa-kiwi-bird',
                    'applytoroom' => 1
                ],

                [
                    'facility' => 'pets are allowed',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('pets'); },
                    'applytoroom' => 1,
                    'input_type' => 'radio'
                ],

                [
                    'facility' => 'pets are not allowed',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('pets'); },
                    'applytoroom' => 1,
                    'input_type' => 'radio'
                ],

                [
                    'facility' => 'chocolate/cookies',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('Food & drink'); },
                    'applytoroom' => 1
                ],

                [
                    'facility' => 'small chops',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('Food & drink'); }
                ],

                [
                    'facility' => 'resturant',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('Food & drink'); }
                ],

                [
                    'facility' => 'bar',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('Food & drink'); }
                ],

                [
                    'facility' => 'parking',
                    'facility_icon' => 'fa-parking',
                ],

                [
                    'facility' => 'parking garage',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('parking'); }
                ],

                [
                    'facility' => 'secured parking',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('parking'); }
                ],

                [
                    'facility' => 'services',
                    'facility_icon' => 'fa-servicestack',
                ],

                [
                    'facility' => 'ironing services',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('services'); }
                ],

                [
                    'facility' => 'laundry',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('services'); }
                ],

                [
                    'facility' => '24 hours front desk',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('services'); }
                ],

                [
                    'facility' => 'safety & security',
                    'facility_icon' => 'fa-shield-alt',
                ],

                [
                    'facility' => 'CCTV in common areas',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('safety & security'); }
                ],

                [
                    'facility' => '24 hours security',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('safety & security'); }
                ],

                [
                    'facility' => 'general',
                    'facility_icon' => 'fa-microchip',
                    'applytoroom' => 1
                ],

                [
                    'facility' => 'Air conditioning',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('general'); },
                    'applytoroom' => 1
                ],

                [
                    'facility' => 'Groceries Store',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('general'); },
                    'applytoroom' => 1
                ],

                [
                    'facility' => 'City View',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('general'); },
                    'applytoroom' => 1
                ],

                [
                    'facility' => 'Compound Room',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('general'); },
                    'applytoroom' => 1
                ],

                [
                    'facility' => 'Bakony',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('general'); },
                    'applytoroom' => 1
                ],

                [
                    'facility' => 'non smooking throughout',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('general'); },
                    'applytoroom' => 1,
                    'input_type' => 'radio'
                ],

                [
                    'facility' => 'smooking allowed throughout',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('general'); },
                    'applytoroom' => 1,
                    'input_type' => 'radio'
                ],

                [
                    'facility' => 'bathroom',
                    'facility_icon' => 'fa-bathroom',
                    'applytoroom' => 1
                ],

                [
                    'facility' => 'private bathroom',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('bathroom'); },
                    'applytoroom' => 1
                ],

                [
                    'facility' => 'shared bathroom',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('bathroom'); },
                    'applytoroom' => 1
                ],

                [
                    'facility' => 'ensuite bathroom',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('bathroom'); },
                    'applytoroom' => 1
                ],

                [
                    'facility' => 'shower only',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('private bathroom'); },
                    'applytoroom' => 1,
                    'input_type' => 'radio'
                ],

                [
                    'facility' => 'bathhub only',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('private bathroom'); },
                    'applytoroom' => 1,
                    'input_type' => 'radio'
                ],

                [
                    'facility' => 'shower & bathhub',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('private bathroom'); },
                    'applytoroom' => 1,
                    'input_type' => 'radio'
                ],

                [
                    'facility' => 'shower only',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('shared bathroom'); },
                    'applytoroom' => 1,
                    'input_type' => 'radio'
                ],

                [
                    'facility' => 'bathhub only',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('shared bathroom'); },
                    'applytoroom' => 1,
                    'input_type' => 'radio'
                ],

                [
                    'facility' => 'shower & bathhub',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('shared bathroom'); },
                    'applytoroom' => 1,
                    'input_type' => 'radio'
                ],

                [
                    'facility' => 'shower only',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('ensuite bathroom'); },
                    'applytoroom' => 1,
                    'input_type' => 'radio'
                ],

                [
                    'facility' => 'bathhub only',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('ensuite bathroom'); },
                    'applytoroom' => 1,
                    'input_type' => 'radio'
                ],

                [
                    'facility' => 'shower & bathhub',
                    'facility_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('ensuite bathroom'); },
                    'applytoroom' => 1,
                    'input_type' => 'radio'
                ],
            ];

            foreach ($facilities as $facility)
            {
                // insert facilities
                $this->table->insert($facility)->go();
            }
        }
    }
}