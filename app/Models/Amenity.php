<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    protected $fillable = [
        'amenity_text',
        'id',
        'status',
        'amenity_uuid'
    ];
}
