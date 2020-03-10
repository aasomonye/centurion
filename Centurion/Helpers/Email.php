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

    // resend activation link
    public static function resendActivationLink(&$controller, &$view)
    {
        // get user 
        $user = \Guards::user();

        // get account
        $account = \Guards::account();

        // get lockid
        $lockid = $user->from('authentication', 'userid')->pick('lockid');

        // get activation code for this account
        $activationCode = $user->from('activations', 'userid')->get('lockid=?', 4)->activation_code;

        // send mail
        self::getTemplate('resend activation', [
            'link' => url('complete-registration/' . $activationCode),
            'year' => date('Y')
        ])->send('Account Activation', $user->email_address);

        // get base controller and view
        list($controller, $view) = explode('/', $account->account_base_url);

        // message sent
        Alert::toastDefaultSuccess('Please check your mail for activation link.');
    }
}