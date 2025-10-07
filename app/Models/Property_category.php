<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property_category extends Model
{
    protected $fillable = [
        'pcamenity_text',
        'id',
        'status',
        'pcamenity_uuid'
    ];
}
