<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property_amenity_list extends Model
{
    protected $table = 'property_amenity_lists';
    protected $fillable =[
        'property_id',
        'property_amenity_id',
        'property_no_of_amenity'
    ];
     public $timestamps = false;
}
