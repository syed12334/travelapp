<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property_room_category extends Model
{
    protected $fillable =[
        'property_id',
        'room_category_id',
        'occupancy',
        'no_of_rooms',
        'price',
        'tax',
        'discount',
        'room_image',
        'rate_inclusion'
    ];
}
