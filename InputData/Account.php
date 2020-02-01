<?php
namespace InputData;

use Moorexa\Apimodel as Model;
use Moorexa\InputData\Rule;

/**
 * @package Account input rules
 */
class Account extends Model
{
    // login rule for users
    public function setLoginRule(Rule $data)
    {
        $data->table = 'account';
        $data->username('string|required|notag|min:1', 'chris');
    }
}