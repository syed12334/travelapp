<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [
        'id',
        'state_uuid',
        'name'
    ];
     /* Fetch all active states records by scope */
    public function scopeActive($query) {
        return $query->where('status',1);
    }
}
