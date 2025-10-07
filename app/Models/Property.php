<?php

namespace App\Models;

use App\Models\User;
use App\Models\Property_personal_detail;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    public $fillable = [
        'property_id',
        'property_name',
        'booking_start_year',
        'booking_start_year',
        'property_hosted',
        'property_hosted',
        'email',
        'mobile_no',
        'whatsapp_no',
        'landline_no'
    ];
    /* Fetch username in properties */
    public function users() {
        return $this->belongsTo(User::class);
    }
    /* Fetch Property Details */
    public function propertyDetails() {
        return $this->hasOne(Property_personal_detail::class);
    }
}
