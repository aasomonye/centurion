<?php
namespace Centurion\Helpers;

class EmailTemplate
{
    // binds
    public static $templateBinds = [
        '{name}' => 'Customer full name',
        '{ipaddress}' => 'Customer ip address',
        '{link}' => 'URl for action button',
        '{date}' => 'full date like "23rd dec 2020"'
    ];

    // stylesheet used
    public static function stylesheet()
    {
        return <<<EOT
            <style id="template-stylesheet">
                @import url('https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap');
                .template-wrapper{display: flex; justify-content: center; align-items: center; padding: 30px;
                box-shadow: 0px 0px 10px rgba(0,0,0,0.2); width: 95%; margin: auto; margin-top: 20px; color: #12233E;}
                .template-wrapper .template-body{width: 80%; margin: 0 auto; text-align: center; font-family: 'Poppins', sans-serif; line-height: 26px;}
                .template-wrapper .template-body h1{font-weight: 700; font-family: 'Poppins', sans-serif; margin-bottom: 30px; font-size: 35px;}
                .template-wrapper .template-body p{font-size: 16px; margin-bottom: 30px;}
                .template-wrapper .template-body .template-button{margin-bottom: 30px;}
                .template-wrapper .template-body .template-button a{display: block; width: 50%; height: 65px; text-align: center;
                color: #fff; background-color: #FF4E00; font-size: 16px; border-radius: 40px; margin: 0 auto;
                display: flex; justify-content: center; align-items: center; text-decoration:none;}
                .template-wrapper .template-body .template-footer ul{list-style: none; display: flex; justify-content: center;}
                .template-wrapper .template-body .template-footer ul li{padding-right: 6px; padding-left: 6px; opacity: 0.27;
                padding-top: 0px; position: relative;}
                .template-wrapper .template-body .template-footer ul li::after{
                    position: absolute;
                    top: 0;
                    right: 0;
                    content: "|";
                    width: 1px;
                    height: 100%;
                    color: #12233E;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
                .template-wrapper .template-body .template-footer ul li:last-child:after{content: '';}
                .template-wrapper .template-body .template-footer ul li:hover{opacity: 1;}
                .template-wrapper .template-body .template-footer ul li a{text-decoration:none; font-size:14px; color:#12233E;}
                .template-wrapper .template-body .template-footer .template-footer-text{display: block; margin-bottom: 20px;
                font-size: 14px;}
                .template-wrapper .template-body .template-footer .template-footer-small-text{font-size: 12px; opacity: 0.3;
                max-width: 70%; display: block; margin: auto;}
                .template-wrapper .template-body .template-footer .template-footer-small-text a{text-decoration: underline;}
            </style>
EOT;
    }

    // get template
    public static function getTemplate(string $templateName, array $binds)
    {
        // add binds
        $getBinds = self::$templateBinds;

        foreach ($binds as $bindTarget => $bindValue)
        {
            if (isset($getBinds['{'.$bindTarget.'}']))
            {
                $getBinds['{'.$bindTarget.'}'] = $bindValue;
            }
        }

        // get template
        $emailTemplate = db('email_templates')->get('template_name = ?', $templateName);

        if ($emailTemplate->rows > 0)
        {
            // get body
            $emailTemplate = $emailTemplate->template_body;

            // replace all binds
            foreach ($getBinds as $bindTarget => $bindValue)
            {
                $emailTemplate = str_replace($bindTarget, $bindValue, $emailTemplate);
            }

            // add stylesheet
            $emailTemplate = self::stylesheet() . $emailTemplate;

            // return template
            return $emailTemplate;
        }

        // not found
        return null;
    }
}