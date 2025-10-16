<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property_room_category_amenity extends Model
{
    protected $fillable =[
        'property_room_category_id',
        'room_amenity_id'
    ];
}
