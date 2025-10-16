<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property_photo extends Model
{
    protected $table = 'property_photos';
   protected $fillable =[
        'property_id',
        'photo_path'
    ];
    public $timestamps = false;
}
