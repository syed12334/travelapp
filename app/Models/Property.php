<?php

namespace App\Models;

use App\Models\User;
use App\Models\Property_personal_detail;
use App\Models\Property_faq;
use App\Models\Property_house_rule;
use App\Models\Property_addon_info;
use App\Models\Property_amenity_list;
use App\Models\Property_photo;
use App\Models\Property_youtube_link;
use App\Models\PropertyRoomCategory;
use App\Models\PropertyRoomAmenity;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table="properties";
    public $fillable = [
        'property_id',
        'property_uuid',
        'state',
        'city',
        'user_id',
        'property_type',
        'postal_address',
        'property_name',
        'booking_start_year',
        'property_built_date',
        'property_hosted',
        'email',
        'mobile_no',
        'whatsapp_no',
        'landline_no',
        'property_location'
    ];
    /* Fetch username in properties */
    public function users() {
        return $this->belongsTo(User::class);
    }
    /* Fetch property personal details */
    public function propertyDetails() {
        return $this->hasOne(Property_personal_detail::class);
    }
    /* Fetch property faq details */
    public function propertyFaq() {
        return $this->hasMany(Property_faq::class);
    }
    /* Fetch property house rules details */
    public function propertyHouseRules() {
        return $this->hasOne(Property_house_rule::class);
    }
    /* Fetch property addon rules details */
    public function propertyAddonInfo() {
        return $this->hasOne(Property_addon_info::class);
    }
    /* Fetch property photos details */
    public function propertyPhotos() {
        return $this->hasMany(Property_photo::class);
    }
    /* Fetch property photos details */
    public function propertyYoutubeLink() {
        return $this->hasMany(Property_youtube_link::class);
    }
    /* Fetch property amenity list details */
    public function propertyAmenityList() {
        return $this->hasMany(Property_amenity_list::class);
    }
    /* Fetch property room category details */
    public function propertyRoomCategoryList() {
        return $this->hasMany(PropertyRoomCategory::class);
    }
    public static function fetchAllPropertyDetails($user_id)
    {
        return self::with([
            'propertyDetails',
            'propertyFaq',
            'propertyHouseRules',
            'propertyAddonInfo',
            'propertyPhotos',
            'propertyYoutubeLink',
            'propertyAmenityList',
            'propertyRoomCategoryList'=>function($query) {
                $query->with('propertyRoomCateAmenity');
            }
        ])
        ->where('user_id', $user_id)
        ->get();
    }
}
