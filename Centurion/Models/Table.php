<?php

namespace Centurion\Models;
use Moorexa\Apimodel as Model;
use Moorexa\InputData\Rule;

class Table extends Model
{
    public function setActivation(Rule $data)
    {
        $data->table = 'activations';
        $data->userid('number|required');
        $data->activation_code('string|notag|max:100|required');
        $data->redirect_to('string|notag|max:100');
        $data->satisfied('numeber', 0);
        $data->lockid('number|min:1|required');
    }
}