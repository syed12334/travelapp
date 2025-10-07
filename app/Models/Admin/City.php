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
    public function state() {
        return $this->belongsTo(State::class);
    }
}
