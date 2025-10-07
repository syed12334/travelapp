<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pamenity extends Model
{
      protected $fillable = [
        'pamenity_text',
        'id',
        'status',
        'pamenity_uuid'
    ];
}
