<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property_addon_info extends Model
{
    protected $table = 'property_addon_infos';
    protected $fillable =[
        'property_id',
        'restaurant_info',
        'near_by_location'
    ];
     public $timestamps = false;
}
