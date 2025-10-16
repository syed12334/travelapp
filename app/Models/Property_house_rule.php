<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property_house_rule extends Model
{
    protected $table = 'property_house_rules';
    protected $fillable =[
        'property_id',
        'check_in',
        'check_out',
        'cancel_prepay',
        'children_beds',
        'no_age_restrict',
        'pets',
        'groups',
        'parties',
        'accept_payment_method'
    ];
     public $timestamps = false;
}
