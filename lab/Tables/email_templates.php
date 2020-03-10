<?php

use Moorexa\Structure as Schema;

class Email_templates
{
    // connection identifier
    public $connectionIdentifier = '';


    // create table structure
    public function up(Schema $schema)
    {
        $schema->table = 'email_templates';
        $schema->createStatement("
			emailtemplateid      int  NOT NULL  AUTO_INCREMENT  PRIMARY KEY,
			lockid               int,
			template_name        varchar(100),
			template_body        longtext
		");
        $schema->alterStatement("COMMENT 'email templates for all lock status'");
		$schema->alterStatement("MODIFY template_name varchar(100)     COMMENT 'name of this template. so we can have options'");   
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
        $option->rename('email_templates'); // rename table
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
            $templates = [
                [
                    'lockid' => 0,
                    'template_name' => 'partnership declined',
                    'template_body' => '<div class="template-wrapper">
                    <div class="template-body">
                        <h1>Partnership declined</h1>
                        <p>We are sorry to inform you that your request to be a partner has been declined. Please review the information provided and submit again.</p>
                
                        <div class="template-footer">
                            <ul>
                                <li><a href="">About us</a></li>
                                <li><a href="">Properties</a></li>
                                <li><a href="">Car rental</a></li>
                                <li><a href="">Become a partner</a></li>
                                <li><a href="">Trust & Safety</a></li>
                                <li><a href="">Best price</a></li>
                            </ul>
                            <span class="template-footer-text">
                                © {year} Centurion Apartments Limited. All Rights Reserved. <br> No 30, Wuse Zone 4, Abuja Ciry, Nigeria 
                            </span>
                
                            <span class="template-footer-small-text">
                                You are receiving this email because you signed up for a Centurion account. If you no longer wish to receive these emails, please <a href="">unsubscribe here</a>
                            </span>
                        </div>
                    </div>
                </div>'
                ],

                [
                    'lockid' => 0,
                    'template_name' => 'partnership approved',
                    'template_body' => '<div class="template-wrapper">
                    <div class="template-body">
                        <h1>Partnership approved</h1>
                        <p>We are happy to inform you that your request to be a partner has been approved. So what next? login with your email address to continue. Thank you for choosing centurion.</p>
                
                        <div class="template-footer">
                            <ul>
                                <li><a href="">About us</a></li>
                                <li><a href="">Properties</a></li>
                                <li><a href="">Car rental</a></li>
                                <li><a href="">Become a partner</a></li>
                                <li><a href="">Trust & Safety</a></li>
                                <li><a href="">Best price</a></li>
                            </ul>
                            <span class="template-footer-text">
                                © {year} Centurion Apartments Limited. All Rights Reserved. <br> No 30, Wuse Zone 4, Abuja Ciry, Nigeria 
                            </span>
                
                            <span class="template-footer-small-text">
                                You are receiving this email because you signed up for a Centurion account. If you no longer wish to receive these emails, please <a href="">unsubscribe here</a>
                            </span>
                        </div>
                    </div>
                </div>'
                ]
            ];

            foreach ($templates as $template)
            {
                $this->table->config([
                    'allowHTML' => true,
                    'allowSlashes' => true
                ])->insert($template)->go();
            }
        }
    }
}