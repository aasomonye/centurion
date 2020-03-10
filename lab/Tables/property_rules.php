<?php

use Moorexa\Structure as Schema;

class Property_rules
{
    // connection identifier
    public $connectionIdentifier = '';


    // create table structure
    public function up(Schema $schema)
    {
        $schema->increment('property_ruleid');
        $schema->string('property_rule_title');
        $schema->string('property_rule');
        $schema->string('rule_icon');
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
        $option->rename('property_rules'); // rename table
        $option->engine('innoDB'); // set table engine
        $option->collation('utf8_general_ci'); // set collation
    }

    // get parent id
    public function parentid(string $property_rule_title)
    {
        return db(self::class)->get('property_rule_title = ?', $property_rule_title)->property_ruleid;
    }

    // promise during migration
    public function promise($status)
    {
        if ($status == 'complete')
        {
            $rules = [
                [
                    'property_rule_title' => 'check-in',
                    'property_rule' => '12:00pm - 2:00pm',
                    'rule_icon' => 'fa-calendar'
                ],

                [
                    'property_rule_title' => 'check-out',
                    'property_rule' => '12:00pm - 1:00pm',
                    'rule_icon' => 'fa-calendar'
                ],

                [
                    'property_rule_title' => 'Cancellation/prepayment',
                    'property_rule' => 'Cancellation and prepayment policies vary according to accommodation type. Please enter the dates of your stay and check the conditions of your required room.',
                    'rule_icon' => 'fa-info-circle'
                ],

                [
                    'property_rule_title' => 'Children and beds',
                    'property_rule' => 'Children of any age are welcome.',
                    'rule_icon' => 'fa-child',
                    'applytoroom' => 1
                ],

                [
                    'property_rule_title' => 'children aged 18 years are adults',
                    'property_rule' => 'Children aged 18 years and above are considered adults at this property.',
                    'rule_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('Children and beds');}
                ],

                [
                    'property_rule_title' => 'cots not allowed',
                    'property_rule' => 'There is no capacity for cots at this property.',
                    'rule_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('Children and beds');},
                    'applytoroom' => 1
                ],

                [
                    'property_rule_title' => 'cots allowed',
                    'property_rule' => 'There is capacity for cots at this property.',
                    'rule_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('Children and beds');},
                    'applytoroom' => 1
                ],

                [
                    'property_rule_title' => 'no extra bed',
                    'property_rule' => 'There is no capacity for extra beds at this property.',
                    'rule_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('Children and beds');},
                    'applytoroom' => 1
                ],

                [
                    'property_rule_title' => 'there is extra bed',
                    'property_rule' => 'There is capacity for extra beds at this property.',
                    'rule_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('Children and beds');},
                    'applytoroom' => 1
                ],

                [
                    'property_rule_title' => 'Payment method',
                    'property_rule' => 'Payment methods allowed by this property',
                    'rule_icon' => 'fa-money'
                ],

                [
                    'property_rule_title' => 'Cash',
                    'property_rule' => 'This property accepts cash payments.',
                    'rule_icon' => 'fa-money-bill',
                    'parentid' => function(){return $this->parentid('Payment method');}
                ],

                [
                    'property_rule_title' => 'Cash only',
                    'property_rule' => 'This property accepts only cash payments.',
                    'rule_icon' => 'fa-money-bill-alt',
                    'parentid' => function(){return $this->parentid('Payment method');}
                ],

                [
                    'property_rule_title' => 'Bank transfer',
                    'property_rule' => 'This property accepts bank transfer.',
                    'rule_icon' => 'fa-money-check',
                    'parentid' => function(){return $this->parentid('Payment method');}
                ],

                [
                    'property_rule_title' => 'Bank transfer only',
                    'property_rule' => 'This property accepts only bank transfers.',
                    'rule_icon' => 'fa-money-check-alt',
                    'parentid' => function(){return $this->parentid('Payment method');}
                ],

                [
                    'property_rule_title' => 'Card',
                    'property_rule' => 'This property accepts credit/debit card payments.',
                    'rule_icon' => 'fa-credit-card',
                    'parentid' => function(){return $this->parentid('Payment method');}
                ],

                [
                    'property_rule_title' => 'Card only',
                    'property_rule' => 'This property accepts only credit/debit card payments.',
                    'rule_icon' => 'fa-credit-card',
                    'parentid' => function(){return $this->parentid('Payment method');}
                ],

                [
                    'property_rule_title' => 'Smooking',
                    'property_rule' => 'Do property allow smooking within her premises',
                    'rule_icon' => 'fa-smooking',
                    'applytoroom' => 1
                ],

                [
                    'property_rule_title' => 'not allowed',
                    'property_rule' => 'Smooking not allowed',
                    'rule_icon' => 'fa-smooking-ban',
                    'parentid' => function(){return $this->parentid('Smooking');},
                    'applytoroom' => 1,
                    'input_type' => 'radio'
                ],

                [
                    'property_rule_title' => 'allowed',
                    'property_rule' => 'Smooking allowed',
                    'rule_icon' => 'fa-smooking',
                    'parentid' => function(){return $this->parentid('Smooking');},
                    'applytoroom' => 1,
                    'input_type' => 'radio'
                ],

                [
                    'property_rule_title' => 'Parties/Event',
                    'property_rule' => 'Do property allow parties/event within her premises',
                    'rule_icon' => 'fa-guitar'
                ],

                [
                    'property_rule_title' => 'not allowed',
                    'property_rule' => 'Parties/events are not allowed',
                    'rule_icon' => 'fa-mixer',
                    'parentid' => function(){return $this->parentid('Parties/Event');},
                    'input_type' => 'radio'
                ],

                [
                    'property_rule_title' => 'allowed',
                    'property_rule' => 'Parties/events are allowed',
                    'rule_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('Parties/Event');},
                    'input_type' => 'radio'
                ],

                [
                    'property_rule_title' => 'Pets',
                    'property_rule' => 'Do property allow pets within her premises',
                    'rule_icon' => 'fa-dog',
                    'applytoroom' => 1
                ],

                [
                    'property_rule_title' => 'not allowed',
                    'property_rule' => 'Pets are not allowed',
                    'rule_icon' => 'fa-mixer',
                    'parentid' => function(){return $this->parentid('Pets');},
                    'applytoroom' => 1,
                    'input_type' => 'radio'
                ],

                [
                    'property_rule_title' => 'allowed',
                    'property_rule' => 'Pets are allowed',
                    'rule_icon' => 'fa-check',
                    'parentid' => function(){return $this->parentid('Pets');},
                    'applytoroom' => 1,
                    'input_type' => 'radio'
                ],
            ];

            foreach ($rules as $rule)
            {
                $this->table->insert($rule)->go();
            }
        }
    }
}