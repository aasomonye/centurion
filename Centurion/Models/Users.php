<?php
namespace Centurion\Models;

use Moorexa\Apimodel as Model;
use Moorexa\InputData\Rule;
use Centurion\Models\Input;
use Guards as Auth;

/**
 * @package Users input rules
 */
class Users extends Model
{
    // set default table name
    public $table = 'users';

    // set rules
    const EMAIL_RULE = 'email|required|notag|min:10';
    const PASSWORD_RULE = 'string|required|min:4';
    const TEXT_RULE = 'required|string|notag|min:3';

    // login rule for users
    public function setLoginRule(Rule $data)
    {
        // flag required inputs if POST method
        $data->flag_required_if = 'POST';
        
        $data->email_address(self::EMAIL_RULE);
        $data->password(self::PASSWORD_RULE);
        $data->remember('string','off');
    }

    // registration rule for user
    public function setRegisterRule(Rule $data)
    {
        // flag required inputs if POST method
        $data->flag_required_if = 'POST';

        // build rule
        $data->firstname(self::TEXT_RULE);
        $data->lastname(self::TEXT_RULE);
        $data->email_address(self::EMAIL_RULE);
        $data->password(self::PASSWORD_RULE);
        $data->password_again(self::PASSWORD_RULE);
    }

    // reset password rule
    public function setResetPasswordRule(Rule $data)
    {
        // flag required if post
        $data->flag_required_if = "POST";

        // build rule
        $data->email_address(self::EMAIL_RULE);
    }

    // password reovery rule
    public function setPasswordRecoveryRule(Rule $data)
    {
        // flag required if post
        $data->flag_required_if = "POST";

        // build rule
        $data->password(self::PASSWORD_RULE);
        $data->password_again(self::PASSWORD_RULE);
    } 
    
    // update user information rule
    public function setUserInformationRule(Rule $data)
    {
        // flag required if post
        $data->flag_required_if = 'POST';

        // set table
        $data->table = 'users_information';

        // build rule
        $data->userid = Auth::id();
        $data->next_of_kin_name('required|string|min:2|notag');
        $data->next_of_kin_telephone('required|number|min:10|notag');
        $data->next_of_kin_address('required|string|min:5|notag');
        $data->next_of_kin_relationship('required|string|min:5|notag');
        $data->telephone('required|number|min:10|notag');
        $data->home_address('required|string|min:5|notag');
        $data->work_address('required|string|min:5|notag');

    }

    // set profile update rule
    public function setProfileUpdateRule(Rule $data)
    {
        // flag required if post
        $data->flag_required_if = 'POST';

        // BUILD Rule
        $data->firstname(SELF::TEXT_RULE);
        $data->lastname(SELF::TEXT_RULE);
        $data->home_address(SELF::TEXT_RULE);
        $data->work_address(SELF::TEXT_RULE);
        $data->userid = Auth::id();
    }
}