<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyRoomAmenity extends Model
{
    protected $table = 'property_room_amenities';
   protected $fillable =[
        'id',
        'property_room_category_id',
        'amenity_id'
    ];

    public $timestamps = false; 
}
