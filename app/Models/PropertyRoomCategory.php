<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyRoomCategory extends Model
{
    protected $table = 'property_room_categories';
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
     public $timestamps = false;
      /* Fetch all property room category amenity */
    public function propertyRoomCateAmenity() {
        return $this->hasMany(PropertyRoomAmenity::class);
    }
}
