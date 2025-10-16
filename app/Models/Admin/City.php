<?php

namespace App\Models\Admin;

use App\Models\State;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'id',
        'state_id',
        'city_uuid',
        'city_name',
        'status'
    ];
    /* Fetch all states */
    public function state() {
        return $this->belongsTo(State::class);
    }
    /* Fetch all active cities records by scope */
    public function scopeActive($query) {
        return $query->where('status',1);
    }
}
