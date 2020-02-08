<?php
namespace Centurion\Models;

use Moorexa\Apimodel as Model;
use Moorexa\InputData\Rule;
use Centurion\Models\Input;

/**
 * @package Users input rules
 */
class Users extends Model
{
    // set default table name
    public $table = 'users';

    // login rule for users
    public function setLoginRule(Rule $data)
    {
        // flag required inputs if POST method
        $data->flag_required_if = 'POST';
        
        $data->email_address('email|required|notag|min:10');
        $data->password('string|required|min:4');
        $data->remember('string','off');
    }

    // registration rule for user
    public function setRegisterRule(Rule $data)
    {
        // flag required inputs if POST method
        $data->flag_required_if = 'POST';

        // build rule
        $data->firstname('required|string|notag|min:3');
        $data->lastname('required|string|notag|min:3');
        $data->email_address('required|email|notag|min:10');
        $data->password('required|string|min:4');
        $data->password_again('required|string|min:4');
    }
}