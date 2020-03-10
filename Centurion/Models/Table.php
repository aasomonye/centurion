<?php

namespace Centurion\Models;
use Moorexa\Apimodel as Model;
use Moorexa\InputData\Rule;

class Table extends Model
{
    public const VERIFIED = 1;
    public const DECLINED = 2;

    public function setActivation(Rule $data)
    {
        $data->table = 'activations';
        $data->userid('number|required');
        $data->activation_code('string|notag|max:100|required');
        $data->redirect_to('string|notag|max:100');
        $data->satisfied('numeber', 0);
        $data->lockid('number|min:1|required');
    }

    public function setPartnerVerification(Rule $data, $userid)
    {
        $data->table = 'business_information';
        $data->userid('number|min:1', $userid);
        $data->verified('number|min:1', self::DECLINED);
    } 
    
    public function setPropertyListing(Rule $data)
    {
        $data->table = 'partner_listing';
        $data->userid('number|min:1', \Guards::id());
        $data->listing_type('string|required|min:4|notag', 'property');
        $data->listing_information('string|notag|min:4|required');
        $data->listing_images('string|notag|min:4');
        $data->room_images('string|notag|notag');
    }
}