<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property_log extends Model
{
    protected $fillable = [
        'user_id',
        'session_id',
        'current_page',
        'next_page',
        'property_details',
        'property_details',
        'property_photos_videos',
        'property_amenities',
        'property_room_categories',
        'property_house_rules',
        'property_near_by'
    ];
}
