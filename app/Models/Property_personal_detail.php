<?php

namespace App\Models;

use App\Models\Property;
use Illuminate\Database\Eloquent\Model;

class Property_personal_detail extends Model
{
     public $fillable = [
        'property_id',
        'name_of_host',
        'email',
        'mobile_no',
        'whatsapp_no',
        'profile_img',
        'language_speak',
        'hosting_since',
        'total_num_properties',
        'personal_description'
    ];
    public function property() {
        return $this->belongsTo(Property::class);
    }
}
