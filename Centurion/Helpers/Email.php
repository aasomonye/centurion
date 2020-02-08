<?php

namespace Centurion\Helpers;

use Messaging\Mail;
use Centurion\Helpers\Query;

class Email
{
    private static $subject = '';
    private static $from = 'noreply@centurion.com.ng';
    private static $mailBody = '';
    public  static $userid = 0;

    // get template abstraction
    public static function getTemplate(string $name, array $config)
    {
        // get template
        $template = EmailTemplate::getTemplate($name, $config);

        if ($template != null)
        {
            self::$mailBody = $template;
        }

        return boot()->singleton(Email::class);
    }

    // some magic methods
    public function __call(string $method, array $arguments)
    {
        if ($method == 'send')
        {
            return call_user_func_array(Email::class . '::sendEmail', $arguments);
        }

        return $this;
    }

    // send mail
    public static function sendEmail(string $subject, string $receiver, string $mailBody = '')
    {
        $mail = Mail::init();

        // add config
        $mail->from(self::$from);
        $mail->subject($subject);
        $mail->to($receiver);

        // get body
        $body = $mailBody != '' ? $mailBody : self::$mailBody;

        // does mail body contain html tags ?
        if (preg_match('/(<(.*?)>)/', $body))
        {
            // use html
            $mail->html($body);
        }
        else
        {
            // plain text
            $mail->body($body);
        }

        // send mail
        $sendMail = $mail->send();
 
        if ($sendMail && self::$userid != 0)
        {
            Query::logMessageToDatabase([
                'userid' => self::$userid,
                'message' => $body
            ]);
        }

        return $sendMail;
    }
}