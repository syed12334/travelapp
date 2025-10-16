<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property_youtube_link extends Model
{
    protected $table = 'property_youtube_links';
    protected $fillable =[
        'property_id',
        'youtube_link'
    ];
    public $timestamps = false;
}
